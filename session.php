<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$connection = mysqli_connect("localhost", "root", "", "logindb");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_check = $_SESSION['login_user'];

// Fetch user information with prepared statement to prevent SQL injection
$sql_user = "SELECT email, FirstName, PassengerID FROM passengers WHERE email=?";
$stmt_user = $connection->prepare($sql_user);
$stmt_user->bind_param("s", $user_check);

if (!$stmt_user->execute()) {
    die("Error executing user query: " . $stmt_user->error);
}

$result_user = $stmt_user->get_result();

if ($row_user = $result_user->fetch_assoc()) {
    $login_session = $row_user['email'];
    $first_name = $row_user['FirstName'];
    $passengerID = $row_user['PassengerID'];
} else {
    // Handle the case where no user is found, you might want to redirect to login page
    mysqli_close($connection);
    header('location: login.php');
    exit();
}

// Fetch booking information from the database
$sql_booking = "SELECT * FROM bookings WHERE passengerID = ?";
$stmt_booking = $connection->prepare($sql_booking);
$stmt_booking->bind_param("i", $passengerID);

if (!$stmt_booking->execute()) {
    die("Error executing booking query: " . $stmt_booking->error);
}

$result = $stmt_booking->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row_booking = $result->fetch_assoc()) {
        $ticketNumber = $row_booking['ticketNumber'];
        $FlightNumber = $row_booking['FlightNumber'];
        $SeatNumber = $row_booking['SeatNumber'];
        $FastPassStatus = $row_booking['FastPassStatus'];
    }
} else {
    // No bookings found
    $ticketNumber = "";
    $FlightNumber = "";
    $SeatNumber = "";
    $FastPassStatus = "";
}
if ($result === false) {
    die("Error fetching booking results: " . $stmt_booking->error);
}
$stmt_booking->close();
?>
