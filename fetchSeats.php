<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$flightNumber = $_POST['flightNumber'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT SeatNumber FROM bookings WHERE FlightNumber = ?");
    $stmt->execute([$flightNumber]);

    $seats = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($seats);
} catch(PDOException $e) {
    echo "Connection failed: " + $e->getMessage();
}
?>
