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

function echoHeader($title) {
    echo '<div class="header">
        <div class="title"> 
            <h1>'.$title.'</h1>
        </div>
        <a href="profile.php"><div id="avatar" class="avatar"></div></a>
        <!-- <div id="displayName"></div>
        <div id="email"></div>
        <div id="url" style="display:none"></div> -->
    </div>';
}
function echoFooter($state) {
    $home = "music_note.svg";
    $friends = 'gmail_groups.svg';
    $start = "start.svg";
    $past = "fast_rewind.svg";
    $settings = "settings.svg";
    if ($state == "home") {
        $home = "music_note_checked.svg";
    } else if ($state == "friends") {
        $friends = "gmail_groups_checked.svg";
    } else if ($state == "start") {
        $start = "radio_button_checked.svg";
    } else if ($state == "past") {
        $past = "fast_rewind_checked.svg";
    } else if ($state == "settings") {
        $settings = "settings_checked.svg";
    }
    echo '<div class="footer">
        <button class="footerButton" onclick="location.href=`index.php`">
            <div class="icons">
                <img src="assets/'.$home.'" style="width: 100%; height: 100%"/>
            </div>
            <div style="text-align:center;">home</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/'.$friends.'" style="width: 100%; height: 100%"/>
            </div>
            <div style="text-align:center;">friends</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/'.$start.'" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">start</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/'.$past.'" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">past</div></button>
        <button class="footerButton" onclick="location.href=`settings.php`">
            <div class="icons">
                <img src="assets/'.$settings.'" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">settings</div></button>
    </div>';
}