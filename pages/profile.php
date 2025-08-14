<?php
    include('../include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());
    if (isset($_POST['height']) && isset($_POST['weight'])) {
        setUserHeight($userId, $_POST['height']);
        setUserWeight($userId, $_POST['weight']);
        unset($_POST['height']);
        unset($_POST['weight']);
    }

?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="../stylesheets/styles.css">
    <link rel="stylesheet" href="../stylesheets/footer.css">
    <link rel="stylesheet" href="../stylesheets/header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../scripts/main.js"></script>
</head>

<body>
    <div class="header" style="justify-content: flex-start; gap: 15px">
        <a href="http://[::1]:8888/pages/profile.php"><div id="avatar" class="avatar"></div></a>
        <div class="title"> 
            <h1 id="displayName"></h1>
        </div>
    </div>
    <div class="homeContainer"> 
        <form id="userData" action="http://[::1]:8888/pages/profile.php" method="POST" class="runFormContainer">
            <button type="submit"><p>personal info</p></button>
            <div>
                <p>height <input type="text" id="runDistance" name="height" value="<?php echo getUserHeight($userId); ?>"/> inches</p> <br>
            </div>
            <div>
                <p>weight: <input type="text" id="pace" name="weight" value="<?php echo getUserWeight($userId); ?>"/> lbs</p> <br> 
            </div>
        </form> 
    </div>
   <div class="homeContainer">
        <div><span>email:</span> <span id="email"></span></div>
        <a id="url" target="_blank" style="color: #CE87D9">spotify profile</div></a>
    </div> 
    <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
   </script>
   <?php echoFooter("home"); ?>
</body>

</html>