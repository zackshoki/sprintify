<?php

function getSavedTracksFromSpotify($userId) {
    $savedTracksFromSpotify = getAllSavedTracks($userId);
    return $savedTracksFromSpotify;
}
function saveTracksToDB($userId, $savedTracksFromSpotify) { //figure out how to mmake this happen in the background
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($savedTracksFromSpotify);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData, $userId);
}

