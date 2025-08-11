<?php 
    include("include/init.php");
    $userId = $_POST['userId'] ?? null;
    $savedTracks = $_POST['saved_tracks'] ?? null;

    saveTracksToDB($userId, json_decode($savedTracks, true));
    die;