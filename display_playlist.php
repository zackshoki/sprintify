<?php
    include('include/init.php');
    $token = tokenSetup(); 
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    
    $name = getUser($userId)['name'];
    if (!empty($_POST['run_distance']) && !empty($_POST['pace'])) {
        $distance = $_POST['run_distance'];
        $pace = $_POST['pace'];
    } else {
        header('Location: index.php'); // redirect if the distance and pace are not set
    }
    $playlistId = getUserPlaylist($userId); 
    if (!empty($_POST['height'])) {
        $stride_length = ((float) $_POST['height']) * 0.413 * 0.0254 *2; 
        setStrideLength($userId, $stride_length);
    }
    $minutes = distanceToMinutes($_POST['run_distance'], $_POST['pace']);
    $tempo = paceToTempo($_POST['pace']);

    $songs = constructPlaylist($tempo - 10, $tempo + 10, $minutes, $userId);
    generatePlaylist($playlistId, $songs, "$name's run", $distance, $pace);
    $playlist = getPlaylist($playlistId);
    $playlist_json = json_encode($playlist); 
    $image_blob = base64_encode(file_get_contents($playlist['images'][0]['url']));
    

?>

<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Playlist</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <link rel="stylesheet" href="stylesheets/header.css">
        <link rel="stylesheet" href="stylesheets/playlist.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        <link rel="stylesheet" href="stylesheets/footer.css">
        
    </head>

    <body>
        <?php echoHeader("new run"); ?>
        <div class="playlistContainer">
            <a  class="playlistImage" href=<?php echo $playlist['external_urls']['spotify']; ?> target="_blank"><div id="playlistImage" ></div></a>
            <div class="playlistName"><p id="playlistName"></p></div>
            <div class="playlistDescription"><p id="playlistDescription"></p></div>
        </div>
        <div class="sectionTitle" style="margin: 17px 12px;"><p>songs</p></div>
        <div class="songsContainer">
            <?php echoSongBlocks($playlist); ?>
        </div> 
        <form action="save_playlist.php" method="POST">
            <input name="run_distance" type="text" value="<?php echo $distance ?>" style="display:none;"/>
            <input name="pace" type="text" value="<?php echo $pace ?>" style="display:none;"/>
            <input name="image" type="text" value="<?php echo $image_blob ?>" style="display:none;"/>
            <input name="playlist_id" type="text" value="<?php echo $playlistId ?>" style="display:none;"/>
            <button class="sectionTitle" style="background-color: #f0f0f0" type="submit" id="save"><p>save</p></button> 
        </form>
        <?php echoFooter("start"); ?> 
        <script>
            const profile = <?php echo getSpotifyProfile($userId); ?>;
            const playlist = <?php echo $playlist_json; ?>; 
            const songs = <?php echo json_encode($songs, true) ?>;
            showPlaylist(playlist);
            populateUI(profile);
        </script>
    </body>
</html>


    