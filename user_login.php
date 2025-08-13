<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Sprintify</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <link rel="stylesheet" href="stylesheets/header.css">   
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            function login() {
                window.location.href = 'http://localhost:8888/process/login.php';
            }
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="signUpContainer">
            <div class="title"  style="margin:6px 0px"><h1>Sprintify</h1></div>
            <button onclick="login()" class="signUpButton" style="margin: 0px;padding:17px;"><p>log in with spotify</p></button>
            <div class="signupToLogin"><p>first time? <a href="landing_page.php" style="color: #CE87D9;">sign up</a></p></div>
        </div>
    </body>
</html>