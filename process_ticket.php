<?php
include('session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ticketNumber = $_POST['ticketNumber'];
    $flightNumber = $_POST['flightNumber'];
    $seatNumber = $_POST['seatNumber']; 
    $passengerID = $_POST['passengerID']; // Assuming you are capturing passenger ID

    // Validate and sanitize the data as needed

    // Connect to the database (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logindb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind statement to check for duplicate flight numbers
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM bookings WHERE flightNumber = ?");
    $stmt->bind_param("s", $flightNumber);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the flight number is already in use
    if ((int)$row['count'] > 0) {
        echo "<script>alert('Duplicate flight number detected! Please enter a unique flight number.'); window.history.go(-1);</script>";
    } else {
        // Insert data into the database if no duplicate is found
        $sql = "INSERT INTO bookings (ticketNumber, flightNumber, seatNumber, passengerID, FastPassStatus) VALUES (?, ?, ?, ?, 'False')";
        $insert_stmt = $conn->prepare($sql);
        $insert_stmt->bind_param("ssss", $ticketNumber, $flightNumber, $seatNumber, $passengerID);
        
        if ($insert_stmt->execute()) {
            echo "Ticket information successfully stored in the database.";
            header("location: baggage_form.php");
            exit();
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
