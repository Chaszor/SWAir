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
            background-image: url('Resources/images/hphero-geo-MBS-bkg-20240227.jpg');
            background-repeat: no-repeat;
            background-attachment: local;
            background-size:contain;
        }
    </style>
    <img src="Resources/images/SWFastAir.png" alt="SWFastAir">
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
