<?php

function saveTracksToDB($userId) { //figure out how to mmake this happen in the background
    $savedTracksFromSpotify = array_slice(getAllSavedTracks(), random_int(0, 600), 50);
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($reccoTrackData);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData, $userId);
}

function queueTrackAnalyzingForUser($userId) {
    // insert row into songProcessing table
    initializeSongProcessingForUser($userId);
    // make a curl request that we don't need to wait for a response
    $curl_handler = curl_init();
    $curl_options = [
        CURLOPT_URL => "http://localhost:8888/async/initialize_song_processing_for_user.php",
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POSTFIELDS => json_encode([ "userId" => $userId ])

    ];

    runCurlRequest($curl_handler, $curl_options);
    // return the user at some point
}

function initializeSongProcessingForUser($userId) {
    dbQuery("
        INSERT INTO
            songProcessing (userId, status)
            VALUES ($userId, 'queued')
    ");
}