<?php
    include('include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    // saveTracksToDB($userId); // this was commented out to make reloads faster. still havent found a good way to save all your songs to the db at once. 
    // maybe we should scan all the songs in the database for songs that match the songs that a new user is trying to upload and cancel those uploads while just uploading to the songs to users table
    // also we might store a pointer to what point in the amount of songs that a we are into uploading a specific user's songs and push that counter forward each time we upload data about a new batch or access that the song is available. 
    if (isset($_POST['height']) && isset($_POST['weight'])) {
        setUserHeight($userId, $_POST['height']);
        setUserWeight($userId, $_POST['weight']);
        unset($_POST['height']);
        unset($_POST['weight']);
    }

?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/footer.css">
    <link rel="stylesheet" href="stylesheets/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div class="header" style="justify-content: flex-start; gap: 15px">
        <a href="profile.php"><div id="avatar" class="avatar"></div></a>
        <div class="title"> 
            <h1 id="displayName"></h1>
        </div>
    </div>
    <div class="homeContainer"> 
        <form id="userData" action="profile.php" method="POST" class="runFormContainer">
            <button type="submit"><p>personal info</p></button>
            <div>
                <p>height <input type="text" id="runDistance" name="height" value="<?php echo getUserHeight($userId); ?>"/> inches</p> <br>
            </div>
            <div>
                <p>weight: <input type="text" id="pace" name="weight" value="<?php echo getUserWeight($userId); ?>"/> lbs</p> <br> 
            </div>
        </form> 
    </div>
    <!-- <div class="homeContainer">
        <div id="displayName"></div>
        <div id="email"></div>
        <div id="url" style="display:none"></div>
    </div> -->
    <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
   </script>
   <?php echoFooter("home"); ?>
</body>

</html>