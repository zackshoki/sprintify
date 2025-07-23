<?php

function saveTracksToDB($userId) { //figure out how to mmake this happen in the background
    $savedTracksFromSpotify = array_slice(getAllSavedTracks($userId), random_int(0, 600), 10);
    $reccoTrackData = spotifyIdsToReccoData($savedTracksFromSpotify);
    $analyzedTracks = analyzeTracks($reccoTrackData);
    $mergedTrackData = mergeSongDataFromRecco($reccoTrackData, $analyzedTracks);
    storeTrackData($mergedTrackData, $userId);
}

