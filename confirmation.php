<?php
// Include session file to access session variables
include('session.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $cardHolderName = $_POST['cardHolderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryMonth = $_POST['expiryMonth'];
    $expiryYear = $_POST['expiryYear'];
    $cvv = $_POST['cvv'];

    // Validate credit card number
    // You can add your validation logic here if needed

    // For demonstration purposes, let's just output a success message
    //echo "Payment successful! Thank you, $cardHolderName, for your purchase.<br><br>";
    //echo '<a href="profile.php"><button>Back to Profile</button></a>';
} else {
    // Redirect to the checkout page if accessed directly
    //header("location: profile.php");
    //exit; // Ensure script stops execution after redirection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Team Bugbasher">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>Confirmation - SW Fast Air</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
</head>
<body>

<div>
    <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px); padding: 10px; background-color: rgb(255, 191, 39);" >
</div>

<div class="" style="position: absolute;">
    <strong class="" style="color: rgb(255, 191, 39); top: 30px; left: 30px; width: 700px; line-height: 1.3em; font-size: 40px;  position: absolute; text-align: left;">
        <span class="">Welcome to Southwest</span><br>
        <span class=""><i>Fast-Air</i></span>
    </strong>
    <img src="Resources/images/SWLOGO2.png" alt="SWFastAir" style="transform: translate(570px,-185px) scale(0.70);" >
</div>

<div class="navbar">
    <ul>
        <li><a href="profile.php">Go Back</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</div>
<h1 class="heading">
    <img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">
    Upgrade Your Ticket!
    <img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">
</h1>
<p class="dashboard">
    Welcome, <b><?php echo $first_name; ?></b><br>
</p>
<div class="checkoutform">
    <!-- Display confirmation message -->
    <h2>Payment Confirmation</h2>
    <p>Payment successful! Thank you for your purchase, </p>
    <hr>
    <a href="profile.php"><button>Back to Profile</button></a>
</div>
</body>
</html>
