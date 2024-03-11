<?php
include('employee_login_back.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
//session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Team Bugbasher">
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
                <img src="Resources/images/SWLOGO2.png" alt="SWFastAir" style="transform: translate(570px,-185px) scale(0.70);" >
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
        <form method="post" action="employee_login_back.php" align="center">
            <label for="employeeID">Employee ID:</label>
            <input type="text" id="employeeID" name="employeeID" required><br>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
    
            <input type="submit" value="Login">
        </form>
    </div>

    <!-- You can remove the processing code from here -->
</body>
</html>
