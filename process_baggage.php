<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ticketNumber = $_POST["ticketNumber"];
    $passengerID = $_POST["passengerID"];
    var_dump($ticketNumber);
    // Process Bag 1
    $bag1Weight = $_POST["bag1Weight"];
    $bag1SpecialRequests = $_POST["bag1SpecialRequests"];

    // Process Bag 2
    $bag2Weight = $_POST["bag2Weight"];
    $bag2SpecialRequests = $_POST["bag2SpecialRequests"];

    // Process Bag 3
    $bag3Weight = $_POST["bag3Weight"];
    $bag3SpecialRequests = $_POST["bag3SpecialRequests"];

    // Check if any baggage information is provided before adding to the database
    if (!empty($bag1Weight) || !empty($bag2Weight) || !empty($bag3Weight)) {
        // Insert Bag 1 information into the checkedbags table if not empty
        if (!empty($bag1Weight)) {
            $insertBag1Query = "INSERT INTO `checkedbags` (`ticketNumber`, `PassengerID`, `Weight`, `BagStatus`, `SpecialRequests`)
                                VALUES ('$ticketNumber', '$passengerID', '$bag1Weight', 'In Process', '$bag1SpecialRequests')";
            mysqli_query($connection, $insertBag1Query);
        }

        // Insert Bag 2 information into the checkedbags table if not empty
        if (!empty($bag2Weight)) {
            $insertBag2Query = "INSERT INTO `checkedbags` (`ticketNumber`, `PassengerID`, `Weight`, `BagStatus`, `SpecialRequests`)
                                VALUES ('$ticketNumber', '$passengerID', '$bag2Weight', 'In Process', '$bag2SpecialRequests')";
            mysqli_query($connection, $insertBag2Query);
        }

        // Insert Bag 3 information into the checkedbags table if not empty
        if (!empty($bag3Weight)) {
            $insertBag3Query = "INSERT INTO `checkedbags` (`ticketNumber`, `PassengerID`, `Weight`, `BagStatus`, `SpecialRequests`)
                                VALUES ('$ticketNumber', '$passengerID', '$bag3Weight', 'In Process', '$bag3SpecialRequests')";
            mysqli_query($connection, $insertBag3Query);
        }

        // Output success message or handle errors accordingly
        echo "Baggage information submitted successfully.";
    } else {
        // Output a message indicating that no baggage information was provided
        echo "No baggage information provided. Nothing added to the database.";
    }

    // Redirect to profile.php
    header("Location: profile.php");

    // Close the database connection
    mysqli_close($connection);
} else {
    // Redirect to the home page if accessed directly
    header("Location: profile.php");
    exit();
}
?>
