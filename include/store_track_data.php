<?php

function getSavedTracksFromSpotify() {
    $savedTracksFromSpotify = getAllSavedTracks();
    return $savedTracksFromSpotify;
}
function saveTracksToDB($userId, $savedTracksFromSpotify) { //figure out how to mmake this happen in the background
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($savedTracksFromSpotify);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData, $userId);
}

