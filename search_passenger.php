<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['login_employee'])) {
    header("Location: employee_login.php");
    exit();
}

// Retrieve employee ID from the session
$employeeID = $_SESSION['login_employee'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employee details from the database based on employeeID
$sql = "SELECT * FROM employees WHERE employeeID = '$employeeID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $employeeData = $result->fetch_assoc();
} else {
    // Handle the case where employee data is not found
    echo "Employee data not found.";
    exit();
}

// Retrieve the search term from the form
$passengerEmail = isset($_GET['passengerEmail']) ? $_GET['passengerEmail'] : '';

// Use passengerID from the passengers table
$sqlPassengers = "SELECT * FROM passengers WHERE email LIKE '%$passengerEmail%'";
$resultPassengers = $conn->query($sqlPassengers);

$sqlCheckedbags = "SELECT * FROM checkedbags WHERE passengerID IN (SELECT passengerID FROM passengers WHERE email LIKE '%$passengerEmail%')";
$resultCheckedbags = $conn->query($sqlCheckedbags);

$sqlBookings = "SELECT * FROM bookings WHERE passengerID IN (SELECT passengerID FROM passengers WHERE email LIKE '%$passengerEmail%')";
$resultBookings = $conn->query($sqlBookings);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>Search Results</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
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
</head>
<body>
    
    <div class="navbar">
        <ul>
            <li><a href="employee_profile.php">Back</a></li>
            <!-- Add more menu items based on your application's structure -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <h1 class="heading">Passenger Search Results</h1>

    <div class="search-results">
        <h2>Passenger:</h2>
        <?php
        // Display results from the passengers table
        if ($resultPassengers && $resultPassengers->num_rows > 0) {
            while ($row = $resultPassengers->fetch_assoc()) {
                // Display relevant information from the passengers table
                echo "<div class='empresults'>";
                echo "<p><strong>Passenger ID:</strong> " . $row['PassengerID'] . "<br>";
                echo "<strong>Name:</strong> " . $row['FirstName'] . " " . $row['LastName'] . "<br>";
                echo "<strong>Email:</strong> " . $row['Email'] . "<br>";
                echo "</p>";
                echo "</div>";
                // Add more details as needed
                

            }
        } else {
            echo "No results from Passengers table.";
        }
        echo "<hr>";
        ?>

        <h2>Booking Results:</h2>
        <?php
        // Display results from the bookings table
        if ($resultBookings && $resultBookings->num_rows > 0) {
            while ($row = $resultBookings->fetch_assoc()) {
                // Display relevant information from the bookings table
                // Adjust as per your table structure
                echo "<div class='empresults'>";
                echo "<p><strong>Booking ID:</strong> " . $row['ticketNumber'] . "<br>";
                echo "<strong>Passenger ID:</strong> " . $row['PassengerID'] . "<br>";
                echo "<strong>Seat Number:</strong> " . $row['SeatNumber'] . "<br>";
                echo "<strong>Fast Pass Status:</strong> " . $row['FastPassStatus'] . "<br>";
                echo "</p>";
                echo "</div>";
                // Add more details as needed
                
            }
        } else {
            echo "No results from Bookings table.";
        }
        echo "<hr>";
        ?>

        <h2>Checked Bags:</h2>
        <?php
        // Display results from the checkedbags table
        if ($resultCheckedbags && $resultCheckedbags->num_rows > 0) {
            while ($row = $resultCheckedbags->fetch_assoc()) {
                // Display relevant information from the checkedbags table
                // Adjust as per your table structure
                echo "<div class='empresults'>";
                echo "<p><strong>Bag ID:</strong> " . $row['BagID'] . "<br>";
                echo "<strong>Ticket Number: " . $row['ticketNumber'] . "<br>";
                echo "<strong>Weight:</strong> " . $row['Weight'] . "<br>";
                echo "<strong>Bag Status:</strong> " . $row['BagStatus'] . "<br>";
                echo "<strong>Special Requests:</strong> " . $row['SpecialRequests'] . "<br>";
                echo "</p>";
                echo "</div>";
                // Add more details as needed
                
            }
        } else {
            echo "No results from Checkedbags table.";
        }
        echo "<hr>";
        ?>


    </div>
</body>
</html>
