<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    //$employeeID = $_POST["employeeID"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize user input (you may want to implement more robust validation)
    //$employeeID = mysqli_real_escape_string($conn, $employeeID);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password before storing it (you should use a secure hashing algorithm)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert employee data into the employees table
    $sql = "INSERT INTO employees (employeeID, name, email, password) VALUES (NULL, '$name', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Account created successfully!";
        // You can redirect the employee to the login page or another page after successful registration
        header("location: employee_login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
