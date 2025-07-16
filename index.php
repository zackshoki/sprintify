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
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div class="header">
        <div class="title"> 
            <h1>Sprintify</h1>
        </div>
        <div id="avatar"></div>
        <div id="displayName"></div>
        <div id="email"></div>
        <div id="url" style="display:none"></div>
    </div>
    <div class="homeContainer"> 
        <div>new run</div>
        <form id="userData" action="display_playlist.php" method="POST">
            <strong>distance:</strong> <input type="text" id="runDistance" name="run_distance" value="3"/> miles <br>
            <strong>desired pace:</strong> <input type="text" id="pace" name="pace" value="10"/> min/mi <br> 
            <input type="submit" value="go!"/> 
        </form> 
    </div>
    <div class="footer">

    </div>
    <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
   </script>
</body>

</html>