<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Employee Sign Up</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>
    <style>
        body {
            background-image: url('Resources/images/hphero-geo-MBS-bkg-20240227.jpg');
            background-repeat: no-repeat;
            background-attachment: local;
            background-size: contain;
        }
    </style>
    <img src="Resources/images/SWFastAir.png" alt="SWFastAir">
    <div class="navbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="verification.php">Verification</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="employee_login.php">Employee Login</a></li>
        </ul>
    </div>
    <h1 class="heading">Employee Sign Up</h1>

    <div class="signup">
        <form method="post" action="employee_signup_back.php" align="center">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Create Account">
        </form>
    </div>
</body>
</html>
