<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    unset($_SESSION['username']);
    unset($_SESSION['rol']);
    unset($_SESSION['userId']);
    unset($_SESSION['email']);
?>

<!DOCTYPE html> 
<html lang="en"> 

<head>
    <title> Autentificare </title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href = "https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href = "login.css" type = "text/css">
    <script type="text/javascript" src="login.js"></script>
    <script src= 
        "https://www.google.com/recaptcha/api.js" async defer> 
    </script> 
</head>
<body>
    <div id = "container">
    <div id = "navigation">
    </div>
    <div id = 'wrapper'>
    <div id = "form-container" class = "loginForm">
        <div id = "login" class = "selectedForm">LOGIN</div>
        <div id = "signup">SIGNUP</div>

        <form id = "login-form" action = 'login_try.php' method = 'POST'>
            <div class = "input-container">
                <div class = "label-container"> <a>Email</a> </div>
                <input type = "text" name = "lemail" pattern="[^'\x22]+" required>
            </div>
            <div class = "input-container">
                <div class = "label-container"> <a>Parola</a> </div>
                <input type = "password" name = "lparola" pattern="[^'\x22]+" required>
            </div>
            <div class="g-recaptcha" 
                data-sitekey="6LdkUkUpAAAAAGDq0zj1JrLEYEzltbRWvMGLRt9t"> 
            </div>
            <input type = "submit" id = "button2" value = "LOGIN"/>
            <a href = "guest.php">Or login as guest</a>
        </form>

        <form id  = "signup-form" action = 'signup.php' method = 'POST'>
            <input type = "hidden" name = "action" value = "INSERT">
            <div class = "input-container">
                <div class = "label-container"> <a>Nume</a> </div>
                <input type = "text" name = "nume" pattern="[^'\x22]+" required>
            </div>
            <div class = "input-container">
                <div class = "label-container"> <a>Prenume</a> </div>
                <input type = "text" name = "prenume" pattern="[^'\x22]+" required>
            </div>
            <div class = "input-container">
                <div class = "label-container"> <a>Email</a> </div>
                <input type = "text" name = "email" pattern="[^'\x22]+" required>
            </div>
            <div class = "input-container">
                <div class = "label-container"> <a>Parola</a> </div>
                <input type = "text" name = "parola" pattern="[^'\x22]+" required>
            </div>
            <div class="g-recaptcha" 
                data-sitekey="6LdkUkUpAAAAAGDq0zj1JrLEYEzltbRWvMGLRt9t"> 
            </div>
            <input type = "submit" id = "button" value = "SIGN UP">
        </form>
    </div>
    </div>
    </div>
</body>
</html>