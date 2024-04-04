<?php
include('session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ticketNumber = $_POST['ticketNumber'];
    $flightNumber = $_POST['flightNumber'];
    $seatNumber = $_POST['seatNumber']; // Add this line for seat assignment

    // Validate and sanitize the data as needed

    // Connect to the database (replace these values with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logindb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO bookings (ticketNumber, flightNumber, seatNumber, passengerID, FastPassStatus) VALUES ('$ticketNumber', '$flightNumber', '$seatNumber', '$passengerID', 'False')";

    if ($conn->query($sql) === TRUE) {
        echo "Ticket information successfully stored in the database.";
        header("location: baggage_form.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
