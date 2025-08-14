<?php
    include('../include/init.php');
    tokenSetup();
    $userId = $_SESSION['userId'] ?? createUser(tokenSetup());


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
        <?php echoHeader("settings"); ?>
        <div style="margin:15px">
        <a href="../landing_page.php" style="color: #CE87D9; text-decoration:underline;"><div>
            log out?
        </div></a>
        </div>
        <?php echoFooter("settings"); ?>
        <script defer>
        const profile = <?php echo getSpotifyProfile($userId); ?>;
        populateUI(profile);
        </script>
    </body>
</html>