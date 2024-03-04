<?php
include('login_back.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Login</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>
<style>
            body {
              background-image: url('Resources/images/blueScreen.png');
              background-repeat: no-repeat;
              background-attachment: scroll;
              background-size:cover;
              background-position: center;
            }
            </style>
         <div> <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px);"> </div>

         <div  class=""
         style="position: absolute;"><strong
              class=""
             style="color: rgb(255, 191, 39); top: 30px; left: 30px; width: 700px; line-height: 1.3em; font-size: 40px;  position: absolute; text-align: left;"><span
                 class="">Welcome to Southwest 
                </span><br
                 class=""><span class=""><i>Fast-Air</i> 
                </span></strong> 
                <img src="Resources/images/SWFastAir.png" alt="SWFastAir" style="transform: translate(600px,-10px) scale(0.75);" >
        </div>
    <div class="navbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="verification.php">Verification</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.html">Sign Up</a></li>
            <li><a href="employee_login.php">Employee Login</a></li>
        </ul>
    </div>
    <h1 class="heading"><img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">Login To SW Fast Air<img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60"></h1>
    
    <div class="login">
        <form method="post" align="center">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
    
            <input type="submit" value="Login">
        </form>
    </div>

    <?php
    // Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Now you can use $email and $password for further processing
        // For example, you might want to validate the input or authenticate the user

        // Assuming login is successful, set session variable and redirect
        $_SESSION['login_user'] = $email;
        header('location: profile.php');
        exit();
    }
    ?>
</body>
</html>
