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
        <p><strong>Employee ID:</strong> <?php echo $employeeData['employeeID']; ?></p>
        <!-- Add more details based on your employee database structure -->
        <p><strong>Name:</strong> <?php echo $employeeData['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $employeeData['email']; ?></p>
        <!-- Add more details as needed -->

        <!-- You can customize the profile information based on your database structure -->
    </div>
</body>
</html>
