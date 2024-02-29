<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('employee_session.php');
//var_dump($result);  // Output the result for debugging

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Profile</title>
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
            <!-- Add more menu items based on your application's structure -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <h1 class="heading">Employee Profile</h1>

    <div class="profile-info">
        <div class="empDash">
            <p><strong>Employee ID:</strong> <?php echo $employeeData['employeeID']; ?></p>
            <!-- Add more details based on your employee database structure -->
            <p><strong>Name:</strong> <?php echo $employeeData['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $employeeData['email']; ?></p>
            <!-- Add more details as needed -->
        </div>
        <br>
        
        <div class="search-form">
            <h3>Passenger Search</h3>
            <form action="search_passenger.php" method="GET">
                <label for="passengerEmail">Search Passenger by Email:</label>
                <input type="text" name="passengerEmail" id="passengerEmail" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <!-- You can customize the profile information based on your database structure -->
    </div>
</body>
</html>
