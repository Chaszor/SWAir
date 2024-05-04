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
    <meta name="author" content="Team Bugbasher">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Baggage Information</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>
<style>
            body {
              background-image: url('Resources/images/blueScreen.png');
              background-repeat: no-repeat;
              background-attachment: scroll;
              background-size:cover;
              background-position: center;
            }
            </style>
         <div> <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px);"> </div>

         <div  class=""
         style="position: absolute;"><strong
              class=""
             style="color: rgb(255, 191, 39); top: 30px; left: 30px; width: 700px; line-height: 1.3em; font-size: 40px;  position: absolute; text-align: left;"><span
                 class="">Welcome to Southwest 
                </span><br
                 class=""><span class=""><i>Fast-Air</i> 
                </span></strong> 
                <img src="Resources/images/SWLOGO2.png" alt="SWFastAir" style="transform: translate(570px,-185px) scale(0.70);" >
        </div>
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
        <h3 align="center">Max weight is 50lbs for online checking</h3>
        <!-- Bag 1 -->
        <h2>Bag 1</h2>
        <label for="bag1Weight">Weight (in pounds):</label>
        <input type="number" id="bag1Weight" name="bag1Weight" min=0 max=50><br>

        <label for="bag1SpecialRequests">Special Requests:</label>
        <textarea id="bag1SpecialRequests" name="bag1SpecialRequests" rows="4" cols="50"></textarea><br>

        <!-- Bag 2 -->
        <h2>Bag 2</h2>
        <label for="bag2Weight">Weight (in pounds):</label>
        <input type="number" id="bag2Weight" name="bag2Weight" min=0 max=50 ><br>

        <label for="bag2SpecialRequests">Special Requests:</label>
        <textarea id="bag2SpecialRequests" name="bag2SpecialRequests" rows="4" cols="50"></textarea><br>

        <!-- Bag 3 -->
        <h2>Bag 3</h2>
        <label for="bag3Weight">Weight (in pounds):</label>
        <input type="number" id="bag3Weight" name="bag3Weight" min=0 max=50><br>
        <label for="bag3SpecialRequests">Special Requests:</label>
        <textarea id="bag3SpecialRequests" name="bag3SpecialRequests" rows="4" cols="50"></textarea><br>
        <input type="hidden" id="ticketNumber" name="ticketNumber" value="<?php echo $ticketNumber; ?>">
        <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>">

        <!-- Your existing hidden inputs -->

        <input type="submit" value="Submit Baggage Information">
        <br><br>
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
