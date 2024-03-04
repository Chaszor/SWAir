<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('employee_session.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the ticketNumber parameter is set in the URL
    if (isset($_GET['ticketNumber'])) {
        $ticketNumber = $_GET['ticketNumber'];

        // Validate ticketNumber (you may want to add more validation)
        if (is_numeric($ticketNumber)) {
            // Include your database connection file here
            // Assuming your database connection file is named 'db_connection.php'
            include('db_connection.php');

            // Sanitize the input to prevent SQL injection
            $ticketNumber = mysqli_real_escape_string($connection, $ticketNumber);

            // Update the FastPassStatus in the bookings table
            $updateQuery = "UPDATE bookings SET FastPassStatus = 'true' WHERE ticketNumber = $ticketNumber";

            if (mysqli_query($connection, $updateQuery)) {
                echo "Ticket upgraded successfully!";
            } else {
                echo "Error updating ticket: " . mysqli_error($connection);
            }

            // Close the database connection
            mysqli_close($connection);
        } else {
            echo "Invalid ticket number!";
        }
    } else {
        echo "Ticket number not provided!";
    }
}
?>
