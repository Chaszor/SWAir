<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$dbname = "logindb"; // Change this to your database name
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to select data from the flights table
    $sql = "SELECT * FROM flights";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Fetch all rows as associative arrays
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Team Bugbasher">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Flights</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>
    <style>
        body {
            background-image: url('Resources/images/blueScreen.png');
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
            background-position: center;
        }
    </style>

    <div>
        <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px);">
    </div>

    <div class="" style="position: absolute;">
        <strong class="" style="color: rgb(255, 191, 39); top: 30px; left: 30px; width: 700px; line-height: 1.3em; font-size: 40px;  position: absolute; text-align: left;">
            <span class="">Welcome to Southwest</span><br>
            <span class=""><i>Fast-Air</i></span>
        </strong>
        <img src="Resources/images/SWLOGO2.png" alt="SWFastAir" style="transform: translate(570px,-185px) scale(0.70);">
    </div>

    <div class="navbar">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="flightboard.php">Flights</a></li>
            <li><a href="verification.php">Verification</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.html">Sign Up</a></li>
            <li><a href="employee_login.php">Employee Login</a></li>
        </ul>
    </div>

    <h1 class="heading">
        <img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">Southwest Flight Board
        <img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">
    </h1>

    <br>

    <!-- Display flights table data in HTML table -->
    <table border="1" class="flightboard">
        <thead>
            <tr>
                <th>Flight Number</th>
                <th>Departure Airport</th>
                <th>Arrival Airport</th>
                <th>Departure Date/Time</th>
                <th>Arrival Date/Time</th>
                <th>Flight Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['FlightNumber']; ?></td>
                <td><?php echo $row['DepartureAirport']; ?></td>
                <td><?php echo $row['ArrivalAirport']; ?></td>
                <td><?php echo $row['DepartureDateTime']; ?></td>
                <td><?php echo $row['ArrivalDateTime']; ?></td>
                <td><?php echo $row['FlightStatus']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
