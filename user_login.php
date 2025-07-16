<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Sprintify</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            function login() {
                // submit the form first
                window.location.href = 'login.php';
            }
        </script>
    </head>
    <body>
        <div class="signUpContainer">
            <div class="title">Sprintify</div>
            <button onclick="login()" class="signUpButton"><p>log in with spotify</p></button>
            <div class="signupToLogin"><p>first time? <a href="landing_page.php">sign up</a></p></div>
        </div>
    </body>
</html>