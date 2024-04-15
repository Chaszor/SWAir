<?php
include('session.php'); // Ensure the session and DB connection are included

if(isset($_GET['flightNumber'])) {
    $flightNumber = $_GET['flightNumber'];
    $query = "SELECT COUNT(*) AS FastPassCount FROM bookings WHERE FlightNumber = '$flightNumber' AND UpgradeToFastPass = 1";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode(['fastPassCount' => (int)$row['FastPassCount']]);
    } else {
        echo json_encode(['fastPassCount' => 0]); // Return zero if the query fails or no data
    }

    mysqli_close($connection);
} else {
    echo json_encode(['fastPassCount' => 0]); // Return zero if no flight number is provided
}
?>
