<?php
    include('include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    if (isset($_REQUEST['code'])) {
        $savedTracks = json_encode(getSavedTracksFromSpotify($userId)); 
        $data = [
            "userId" => $userId, 
            "saved_tracks" => $savedTracks
        ];
        $postData = http_build_query($data);
        $postDataEscaped = escapeshellarg($postData);
        exec("curl -X POST -d {$postDataEscaped} http://localhost:8888/process/saving_tracks.php > /dev/null 2>&1 &"); 
    }
    if (isset($_SESSION['height']) && isset($_SESSION['weight'])) { 
        setUserHeight($userId, $_SESSION['height']);
        setUserWeight($userId, $_SESSION['weight']);
        unset($_SESSION['height']);
        unset($_SESSION['weight']);
    }

?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/footer.css">
    <link rel="stylesheet" href="stylesheets/header.css">
    <link rel="stylesheet" href="stylesheets/playlist.css">
    <script type="text/javascript" src="scripts/main.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php echoHeader("Sprintify"); ?>
    <div class="homeContainer"> 
        <div class="sectionTitle"><p>new run</p></div>
        <form id="userData" action="pages/display_playlist.php" method="POST" class="runFormContainer">
            <div>
                <p>distance: <input type="text" id="runDistance" name="run_distance" value="3"/> miles</p> <br>
            </div>
            <div>
                <p>desired pace: <input type="text" id="pace" name="pace" value="10"/> min/mi</p> <br> 
            </div>
            <button type="submit"><p>go!</p></button>
        </form> 
    </div>
    <?php echoPastRuns($userId); ?>
    <?php echoFooter("home"); ?>
    <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
   </script>
</body>

</html>