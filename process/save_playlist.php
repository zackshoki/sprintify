<?php
    include('../include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    saveRun($userId, $_POST['run_distance'], $_POST['pace'], $_POST['image'], $_POST['playlist_id']);
    header('Location: ../index.php');