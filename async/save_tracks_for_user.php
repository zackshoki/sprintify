<?php

include("../include/init.php");
$userId = $_REQUEST['userId'] ?? null;

if(!isset($userId)) {
    // could fail more elegantly if you choose
    die;
}

$user = getUser($userId);

if(!$user) {
    // could fail more elegantly as well
    die;
}

set_time_limit(60);

saveTracksToDB($userId);