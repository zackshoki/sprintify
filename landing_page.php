<?php 
$_SESSION = [];
setcookie("spotify_token", "", time()-3600);
?>
<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Sprintify</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <link rel="stylesheet" href="stylesheets/header.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            
        </script>
    </head>
    <body>
        <div class="signUpContainer">
            <div class="title" style="margin:6px 0px"><h1>Sprintify</h1></div>
            <form id="heightWeight" action="http://localhost:8888/process/login.php" method="POST" class="heightWeightContainer">
                <div class="heightWeight"><p>height: <input type="text" id="height" name="height" class="text formContainer" required /> inches</p></div>
                <div class="heightWeight"><p>weight: <input type="text" id="runDistance" name="weight" class="text formContainer" required /> lbs </p></div>    
                
            </form>
                <button form="heightWeight" type="submit" class="signUpButton text" style="margin: 0px;">sign up with spotify</button> 
            <div class="signupToLogin">have an account? <a href="http://localhost:8888/user_login.php" style="color: #CE87D9">login</a></div>
        </div>
    </body>
</html>