<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

// Get the flight number from POST data
$flightNumber = $_POST['flightNumber'];

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to select seat numbers for passengers with FastPassStatus 'True'
    $stmt = $conn->prepare("SELECT SeatNumber FROM bookings WHERE FlightNumber = ? AND FastPassStatus = 'True'");
    $stmt->execute([$flightNumber]);

    // Fetch all results as an array of seat numbers
    $seats = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Encode the seat numbers array as JSON and output it
    echo json_encode($seats);
} catch(PDOException $e) {
    // Handle any connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
