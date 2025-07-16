<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Sprintify</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            function signup() {
                // submit the form first
                window.location.href = 'login.php';
            }
        </script>
    </head>
    <body>
        <div class="signUpContainer">
            <div class="title">Sprintify</div>
            <form id="userData" class="heightAndWeight" action="login.php" method="POST">
                <strong>height:</strong> <input type="text" id="height" name="height" value="73"/> inches <br> 
                <strong>weight:</strong> <input type="text" id="runDistance" name="run_distance" value="225"/> lbs <br>    
                <!-- these are currently not sent anywhere      -->
            <input type="submit" style="display:none" /> 
            </form>
            <button onclick="signup()" class="signUpButton">sign up with spotify</button>
            <div class="signupToLogin">have an account? <a href="user_login.php">login</a></div>
        </div>
    </body>
</html>