<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace these with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "logindb";

// Create a connection to the database
$con = new mysqli($host, $username, $password, $database);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Assuming you have a table named 'users' with appropriate columns
$email = $_POST['email'];
$rawPassword = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
// Hash the password
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

// Check if the email already exists
$check_query = "SELECT * FROM passengers WHERE Email=?";
$check_stmt = $con->prepare($check_query);
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Duplicate email found, handle the error
    die("Error: Email already exists. Click <a href='signup.html'>here</a> to go Back.");
}

// Use prepared statements to prevent SQL injection
$query = "INSERT INTO passengers (PassengerID, FirstName, LastName, Email, Password) VALUES (NULL, ?, ?, ?, ?)";

$stmt = $con->prepare($query);

// Bind parameters
$stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);

// Execute the query
if ($stmt->execute()) {
    echo "Account Created. Click <a href='login.php'>here</a> to login or go <a href='home.html'>home</a>.";
} else {
    die('Error in inserting records: ' . $stmt->error);
}

// Close the statement and connection
$stmt->close();
$con->close();
?>
