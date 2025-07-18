<?php
    include('include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    // saveTracksToDB($userId); // this was commented out to make reloads faster. still havent found a good way to save all your songs to the db at once. 
    // maybe we should scan all the songs in the database for songs that match the songs that a new user is trying to upload and cancel those uploads while just uploading to the songs to users table
    // also we might store a pointer to what point in the amount of songs that a we are into uploading a specific user's songs and push that counter forward each time we upload data about a new batch or access that the song is available. 


?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <link rel="stylesheet" href="stylesheets/footer.css">
    <link rel="stylesheet" href="stylesheets/header.css">
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <?php echoHeader("Sprintify"); ?>
    <div class="homeContainer"> 
        <div class="sectionTitle"><p>new run</p></div>
        <form id="userData" action="display_playlist.php" method="POST" class="runFormContainer">
            <div>
                <p>distance: <input type="text" id="runDistance" name="run_distance" value="3"/> miles</p> <br>
            </div>
            <div>
                <p>desired pace: <input type="text" id="pace" name="pace" value="10"/> min/mi</p> <br> 
            </div>
            <button type="submit"><p>go!</p></button>
        </form> 
    </div>
    <?php echoFooter("home"); ?>
    <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
   </script>
</body>

</html>