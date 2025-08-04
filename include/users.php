<?php

    function getAllUsers() {
        $users = dbQuery("
            SELECT *
            FROM users 
        ")->fetchAll();
        return $users; // must make sure that archived users are not retrieved
    }

    function createUser($token) { // needs user's spotify profile as a php array
        global $pdo;
        $profile = makeSpotifyGetRequest($token, 'me', "");
        $spotify_id = $profile['id'];
        $userExists = checkIfUserExists($spotify_id);

        if (is_null($userExists)) {
            $total = totalSavedTracks($token);
            $name = $profile['display_name'];
            dbQuery("
                INSERT INTO users (name, spotifyId, profile, total_songs)
                VALUES (:name, :spotifyId, :profile, :total_songs)
            ", [
                ':spotifyId' => $spotify_id, 
                ':profile' => json_encode($profile),
                ':name' => $name,
                ':total_songs' => $total
            ]);
            $userId = $pdo->lastInsertId();
            return $userId;
        } else {
            return getUser($userExists)['userId'];
        }
    }

    function checkIfUserExists($spotify_id) {
        $userId = dbQuery("
            SELECT userId
            FROM users
            WHERE spotifyId = '$spotify_id' 
        ")->fetch()['userId'] ?? NULL;
        return $userId;
    }
    
    // must make sure that archived users are not retrieved
    function getUser($userId) {
        $user = dbQuery("
            SELECT *
            FROM users
            WHERE userId = $userId 
        ")->fetch();
        return $user;
    }
        // deprecated!
        // function setUserSpotifyId($token, $userId) { // takes in my user's id and sends their spotify id & profile to the db
        //     $profile = makeSpotifyGetRequest($token, 'me', "");
        //     $spotify_id = $profile['id'];
            
        //     dbQuery("
        //         UPDATE users 
        //         SET spotifyId= :spotifyId, profile= :profile
        //         WHERE userId= :userId
        //     ", [
        //         ':spotifyId' => $spotify_id, 
        //         ':profile' => json_encode($profile),
        //         ':userId' => $userId
        //     ]);
        // }
    function getSpotifyProfile($userId) {
        $profile_json = getUser($userId)['profile'];
        return $profile_json;
    }   
    function setStrideLength($userId, $stride_length) {
        dbQuery("
            UPDATE users
            SET stride_length = :stride
            WHERE userId = :userId
        ", [
            ":userId" => $userId,
            ":stride" => $stride_length
        ]);
    }
    function getStrideLength($userId) { // in meters, further gain accuracy by separating into walking stride length, jog stride length, run stride length, sprint stride length etc. 
        $stride_length = dbQuery("
            SELECT stride_length
            FROM users
            WHERE userId = $userId 
        ")->fetch()['stride_length'] ?? 1.5;
        return $stride_length;
    }
    function getUserPlaylist($userId) {
        $playlistId = dbQuery("
            SELECT playlistId FROM users WHERE userId='$userId'
        ")->fetch()['playlistId'] ?? NULL;
        if ($playlistId == NULL) {
            $playlistId = createPlaylist("zack's workout playlist", "this a test playlist");
        }
        return $playlistId;
    }
    function sendPlaylistIdToDB($playlistId, $userId) {
        dbQuery("
            UPDATE users SET playlistId= :playlistId WHERE userId= :userId
        ", [
            ':playlistId' => $playlistId, 
            ':userId' => $userId
        ]);
    }
    // deprecated!
    // function setTotalSongs($token, $userId) {
    //     $total = totalSavedTracks($token);
    //     dbQuery(" 
    //         UPDATE users SET total_songs = :total WHERE userId= :userId
    //     ", [
    //         ':total' => $total, 
    //         ':userId' => $userId
    //     ]);
    // }

    function getTotalSongs($userId) {
        $total = dbQuery("
        SELECT total_songs FROM users WHERE userId=$userId
        ")->fetch()['total_songs']; 
        return $total; 
    }
    function setUserHeight($userId, $height) {
        dbQuery("
            UPDATE users SET height= :height WHERE userId= :userId
        ", [
            ':height' => $height, 
            ':userId' => $userId
        ]);
    }
    function setUserWeight($userId, $weight) {
        dbQuery("
            UPDATE users SET weight= :weight WHERE userId= :userId
        ", [
            ':weight' => $weight, 
            ':userId' => $userId
        ]);
    }

    function getUserHeight($userId) {
        $height = getUser($userId)['height'];
        return $height;
    }
    function getUserWeight($userId) {
        $weight = getUser($userId)['weight'];
        return $weight;
    }
    function getPastRuns($userId) { // format is an array of run distances, runpaces, datetimes, and album cover pics. 
        $past_runs = getUser($userId)['past_runs'];
        $past_runs = json_decode($past_runs, true) ?? [];
        return $past_runs;
    }
    function setPastRuns($userId, $past_runs) {
        dbQuery("
            UPDATE users SET past_runs= :past_runs WHERE userId= :userId
        ", [
            ':past_runs' => $past_runs, 
            ':userId' => $userId
        ]);
    }
    function disconnectPlaylist($userId) {
        dbQuery("
            UPDATE users SET playlistId= NULL WHERE userId= :userId
        ", [
            ':userId' => $userId
        ]);
    }
    function saveRun($userId, $run_distance, $pace, $image, $id) {
        $date = date("m/d/Y");
        $run = [
            "run_distance" => $run_distance, 
            "pace" => $pace,
            "date" => $date,
            "image" => $image,
            "id" => $id
        ];
        $past_runs = getPastRuns($userId);
        if ($past_runs == null) {$past_runs[] = $run;}  else {array_push($past_runs, $run);}
        $past_runs = json_encode($past_runs);
        setPastRuns($userId, $past_runs);
        disconnectPlaylist($userId);
    }