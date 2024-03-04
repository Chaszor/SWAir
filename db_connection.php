<?php
$host = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$database = "logindb"; // replace with your database name

// Create a connection to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the character set to utf8mb4 (optional)
mysqli_set_charset($connection, "utf8mb4");

// You can add more configurations or settings based on your requirements

?>
