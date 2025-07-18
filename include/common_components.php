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
    if ($state == "home") {
        // put different things to echo here
    } else if ($state = "friends") {

    } else if ($state = "start") {

    } else if ($state == "past") {
        
    } else if ($state == "settings") {

    }
    echo '<div class="footer">
        <button class="footerButton" onclick="location.href=`index.php`">
            <div class="icons">
                <img src="assets/music_note_checked.svg" style="width: 100%; height: 100%"/>
            </div>
            <div style="text-align:center;">home</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/gmail_groups.svg" style="width: 100%; height: 100%"/>
            </div>
            <div style="text-align:center;">friends</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/start.svg" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">start</div></button>
        <button class="footerButton">
            <div class="icons">
                <img src="assets/fast_rewind.svg" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">past</div></button>
        <button class="footerButton" onclick="location.href=`settings.php`">
            <div class="icons">
                <img src="assets/settings.svg" style="width: 100%; height: 100%" />
            </div>
            <div style="text-align:center;">settings</div></button>
    </div>';
}