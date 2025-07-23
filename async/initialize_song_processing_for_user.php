<?php

include("../include/init.php");

// do some error handlign here for user id etc
$userId = $_REQUEST['userId'] ?? null;
// begin the process of curling save tracks for user.php
fastcgi_finish_request();


// query the db to find the uesr's in progress row
$processingRow = dbQuery("
    SELECT *
    FROM songProcessing
    WHERE userId = $userId
    AND status == 'queued'
")->fetch();

$user = getUser($userId);
$totalTracks = $user['total_songs'];


// then make our own curl requests to save tracks for user.php


/**
 * 1. songsProcessing table needs to know if something is in progress, and if so, how far along is it (e.g. 50 out of 900 songs complete)
 * 2. This file needs to manage curl-ing save_tracks_for_user.php OR we need a cron job to do so
 * 3. save_tracks_for_user.php needs to take parameters for which set of 50 songs we want to ingest during that particular run
 * 4. This means that saveTracksToDB will need to be updated to know which 50 songs to request from Spotify (and therefore ingest)
 */