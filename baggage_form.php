<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('session.php');
if (isset($_GET['ticketNumber'])) {
    $ticketNumber = $_GET['ticketNumber'];
}
if (isset($_GET['PassengerID'])) {
    $passengerID = $_GET['PassengerID'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Baggage Information</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>
<style>
    body {
        background-image: url('Resources/images/hphero-geo-MBS-bkg-20240227.jpg');
        background-repeat: no-repeat;
        background-attachment: local;
        background-size: contain;
    }
</style>
<img src="Resources/images/SWFastAir.png" alt="SWFastAir">
<div class="navbar">
    <ul>
        <li><a href="profile.php">Go Back</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</div>
<h1 class="heading">Checked Baggage Information</h1>
<p class="dashboard">
    Welcome, <b><?php echo $first_name; ?></b><br>
</p>

<div class="baggageForm">
    <form action="process_baggage.php" method="post">
        <!-- Bag 1 -->
        <h2>Bag 1</h2>
        <label for="bag1Weight">Weight (in pounds):</label>
        <input type="number" id="bag1Weight" name="bag1Weight" ><br>

        <label for="bag1SpecialRequests">Special Requests:</label>
        <textarea id="bag1SpecialRequests" name="bag1SpecialRequests" rows="4" cols="50"></textarea><br>

        <!-- Bag 2 -->
        <h2>Bag 2</h2>
        <label for="bag2Weight">Weight (in pounds):</label>
        <input type="number" id="bag2Weight" name="bag2Weight" ><br>

        <label for="bag2SpecialRequests">Special Requests:</label>
        <textarea id="bag2SpecialRequests" name="bag2SpecialRequests" rows="4" cols="50"></textarea><br>

        <!-- Bag 3 -->
        <h2>Bag 3</h2>
        <label for="bag3Weight">Weight (in pounds):</label>
        <input type="number" id="bag3Weight" name="bag3Weight" ><br>
        <label for="bag3SpecialRequests">Special Requests:</label>
        <textarea id="bag3SpecialRequests" name="bag3SpecialRequests" rows="4" cols="50"></textarea><br>
        <input type="hidden" id="ticketNumber" name="ticketNumber" value="<?php echo $ticketNumber; ?>">
        <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>">

        <!-- Your existing hidden inputs -->

        <input type="submit" value="Submit Baggage Information">
    </form>
</div>

<!-- Your existing JavaScript code -->

<!-- Additional content or HTML structure -->

<?php
// Close the database connection
mysqli_close($connection);
?>
</body>
</html>
