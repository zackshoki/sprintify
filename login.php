<?php
include('include/init.php');
if (isset($_POST['height']) && isset($_POST['weight'])) {
    $_SESSION['height'] = $_POST['height'];
    $_SESSION['weight'] = $_POST['weight'];
}
requestUserAuthorization(getClientId());