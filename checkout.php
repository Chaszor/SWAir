<?php
include('session.php');

function validateCreditCard($creditCardNumber) {
    $creditCardNumber = str_replace(' ', '', $creditCardNumber);
    $sum = 0;
    $numDigits = strlen($creditCardNumber);
    $parity = $numDigits % 2;

    for ($i = 0; $i < $numDigits; $i++) {
        $digit = $creditCardNumber[$i];
        if ($i % 2 == $parity) {
            $digit *= 2;
            $digit -= $digit > 9 ? 9 : 0; // Condensed if statement
        }
        $sum += $digit;
    }

    return ($sum % 10 == 0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardHolderName = $_POST['cardHolderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryMonth = $_POST['expiryMonth'];
    $expiryYear = $_POST['expiryYear'];
    $cvv = $_POST['cvv'];

    if (validateCreditCard($cardNumber)) {
        if(isset($_POST['booking']) && is_array($_POST['booking'])) {
            $totalChecked = count($_POST['booking']);
            $totalAmount = 100.00;
            
            foreach($_POST['booking'] as $booking) {
                $sql = "UPDATE bookings SET FastPassStatus = 'True' WHERE ticketNumber = '$booking'";
                mysqli_query($connection, $sql);
                
                $transactionType = "Payment";
                $amount = $totalAmount;
                $description = "Payment for booking $booking";
                $sql = "INSERT INTO transactions (TransactionType, Amount, Description, BookingReferenceNumber, PassengerID) VALUES ('$transactionType', '$amount', '$description', '$booking', '$passengerID')";
                mysqli_query($connection, $sql);
            }
        }
        
        echo "Payment successful! Thank you, $cardHolderName, for your purchase.<br><br>";
        echo '<a href="profile.php"><button>Back to Profile</button></a>';
        header("location: confirmation.php");
        exit(); // Terminating script after header redirect
    } else {
        echo '<script>alert("Invalid credit card number. Please check your card details and try again.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Team Bugbasher">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Home</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
    <script>
    function validateForm() {
        var checkboxes = document.querySelectorAll('input[name="booking[]"]:checked');
        if (checkboxes.length === 0) {
            alert("Please select at least one booking.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission if at least one booking is selected
    }

    function calculateTotalPrice() {
        var checkboxes = document.querySelectorAll('input[name="booking[]"]:checked');
        var totalPriceElement = document.getElementById('totalPrice');
        var totalPrice =  100.00;
        totalPriceElement.innerText = '$' + (checkboxes.length * totalPrice).toFixed(2);

        // Show/hide upgrade button based on checkbox selection
        //var upgradeButton = document.getElementById('upgradeButton');
        //upgradeButton.style.display = checkboxes.length >= 0 ? 'block' : 'none';
    }

    window.onload = function() {
        var checkboxes = document.querySelectorAll('input[name="booking[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', calculateTotalPrice);
        });

        calculateTotalPrice(); // Call once on load to initialize
    };
</script>

</head>
<body>
<div>
    <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px); padding: 10px; background-color: rgb(255, 191, 39);">
</div>
<div  class="" style="position: absolute;">
    <strong class="" style="color: rgb(255, 191, 39); top: 30px; left: 30px; width: 700px; line-height: 1.3em; font-size: 40px;  position: absolute; text-align: left;">
        <span class="">Welcome to Southwest</span><br>
        <span class=""><i>Fast-Air</i></span>
    </strong>
    <img src="Resources/images/SWLOGO2.png" alt="SWFastAir" style="transform: translate(570px,-185px) scale(0.70);">
</div>
<div class="navbar">
    <ul>
        <li><a href="profile.php">Go Back</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</div>
<h1 class="heading"><img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">Upgrade Your Ticket!<img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60"></h1>
<p class="dashboard">
    Welcome, <b><?php echo $first_name; ?></b><br>
</p>
<div class="checkoutform">
    <h1>Checkout</h1>
    <?php if (isset($_SESSION['ticket'])): ?>
        <h2>Ticket Details</h2>
        <?php foreach ($_SESSION['ticket'] as $key => $value): ?>
            <p><?php echo ucfirst($key) . ': ' . $value; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
    <hr>
    <h2>Baggage Information</h2>
    <p>Select the flights you would like to upgrade:</p>
    <form action="" method="post" onsubmit="return validateForm()">
        <?php
        $sql = "SELECT * FROM bookings WHERE FastPassStatus = 'False' AND PassengerID = $passengerID";
        $result = mysqli_query($connection, $sql);
        ?>
        <div id="checkboxes">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php
                $passengerQuery = "SELECT FirstName, LastName FROM passengers WHERE PassengerID = '{$row['PassengerID']}'";
                $passengerResult = mysqli_query($connection, $passengerQuery);
                $passengerRow = mysqli_fetch_assoc($passengerResult);
                ?>
                <label>
                    <input type='checkbox' name='booking[]' value='<?php echo $row['ticketNumber']; ?>' onchange='calculateTotalPrice()'>
                    Booking ID: <?php echo $row['ticketNumber']; ?>, Passenger: <?php echo $passengerRow['FirstName'] . ' ' . $passengerRow['LastName']; ?>
                </label><br>
            <?php endwhile; ?>
            <div class="centered-button">
                <button id="upgradeButton" onclick="location.href='ticketUpgrade.php';">Not seeing your Ticket?</button>
            </div>
        </div>
        <hr>
        
        <h2>Total Price: <span id="totalPrice">$0.00</span></h2>
        <h2>Payment Information</h2>
        <p align="right">
            <label for="cardHolderName">Cardholder Name:</label>
            <input type="text" id="cardHolderName" name="cardHolderName" required><br>

            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" required><br>

            <label for="expiryMonth">Expiry Month:</label>
            <input type="text" id="expiryMonth" name="expiryMonth" required><br>

            <label for="expiryYear">Expiry Year:</label>
            <input type="text" id="expiryYear" name="expiryYear" required><br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required><br>
        </p>
        <div class="centered-button">
            <input type="submit" value="Pay Now">
        </div>
    </form>
</div>
</body>
</html>
