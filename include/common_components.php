<?php

function tokenSetup() {

    if (!isset($_COOKIE['spotify_token'])) { 
        if (isset($_REQUEST['code']) && isset($_REQUEST['state'])) {
            $token = requestAccessToken($_REQUEST['code'], $_REQUEST['state']); 
            $userId = createUser($token);
            $_SESSION['userId'] = $userId ?? createUser($token);
        } else {
            header('Location: login.php'); // work on refresh tokens in the future. 
        }   
    } else {
        $token = $_COOKIE['spotify_token'];
        $userId = createUser($token);
        $_SESSION['userId'] = $userId ?? createUser($token);
    }
    return $token;
}