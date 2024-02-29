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
