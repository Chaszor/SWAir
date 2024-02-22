<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

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

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $employeeID = $_POST["employeeID"];
    $password = $_POST["password"];

    // Validate and sanitize user input (you may want to implement more robust validation)
    $employeeID = mysqli_real_escape_string($conn, $employeeID);
    $password = mysqli_real_escape_string($conn, $password);

    // SQL query to check if the employee exists
    $sql = "SELECT * FROM employees WHERE employeeID = '$employeeID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Employee exists, check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, perform login actions
            echo "Employee Login successful!";
            // You can redirect the employee to another page or perform other actions here
            $_SESSION['login_employee'] = $employeeID;
            header('location: employee_profile.php');
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Employee not found";
    }
}

// Close the database connection
$conn->close();
?>
