<?php
// Include session file to access session variables
include('session.php');

// Function to validate credit card number using Luhn's algorithm
function validateCreditCard($creditCardNumber) {
    $creditCardNumber = str_replace(' ', '', $creditCardNumber); // Remove spaces
    $sum = 0;
    $numDigits = strlen($creditCardNumber);
    $parity = $numDigits % 2;

    for ($i = 0; $i < $numDigits; $i++) {
        $digit = $creditCardNumber[$i];
        if ($i % 2 == $parity) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }

    return ($sum % 10 == 0);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $cardHolderName = $_POST['cardHolderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryMonth = $_POST['expiryMonth'];
    $expiryYear = $_POST['expiryYear'];
    $cvv = $_POST['cvv'];

    // Validate credit card number
    //if (validateCreditCard($cardNumber)) {
    if ($cardNumber > 0){
        // Credit card is valid, proceed with processing
        // You can add your payment processing logic here
        
        // Update FastPassStatus to true for selected bookings
        if(isset($_POST['booking']) && is_array($_POST['booking'])) {
            // Calculate total amount based on the number of checked checkboxes
            $totalAmount = 100.00; // Assuming each booking costs $100, adjust as needed
            
            foreach($_POST['booking'] as $booking) {
                $sql = "UPDATE bookings SET FastPassStatus = 'True' WHERE ticketNumber = '$booking'";
                mysqli_query($connection, $sql);
                
                // Insert transaction details into the transactions table
                $transactionType = "Payment";
                $amount = $totalAmount;
                $description = "Payment for booking $booking";
                $sql = "INSERT INTO transactions (TransactionType, Amount, Description, BookingReferenceNumber) VALUES ('$transactionType', '$amount', '$description', '$booking')";
                mysqli_query($connection, $sql);
            }
        }
        
        // For demonstration purposes, let's just output a success message
        echo "Payment successful! Thank you, $cardHolderName, for your purchase.<br><br>";
        echo '<a href="profile.php"><button>Back to Profile</button></a>';
        header("location: profile.php");
    } else {
        // Credit card is invalid, display error message
        echo "Invalid credit card number. Please check your card details and try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Team Bugbasher">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/style.css">
        <title>SW Fast Air - Home</title>
        <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
    </head>
    <body>
 
    <div> <img src="Resources/images/swa_logo_dark.svg" alt="Southwest" style="transform: translate(30px,0px); padding: 10px; background-color: rgb(255, 191, 39);" > </div>

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
        <h1 class="heading"><img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">Upgrade Your Ticket!<img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60"></h1>
        <p class="dashboard">
            Welcome, <b><?php echo $first_name; ?></b><br>
        </p>
        <div class="checkoutform">
    <h1>Checkout</h1>
    <?php if (isset($_SESSION['ticket'])): ?>
        <h2>Ticket Details</h2>
        <p>Flight Number: <?php echo $_SESSION['ticket']['flightNumber']; ?></p>
        <p>Departure Airport: <?php echo $_SESSION['ticket']['departureAirport']; ?></p>
        <p>Arrival Airport: <?php echo $_SESSION['ticket']['arrivalAirport']; ?></p>
        <p>Passenger Name: <?php echo $first_name . ' ' . $last_name; ?></p>
        <p>Ticket Number: <?php echo $_SESSION['ticket']['ticketNumber']; ?></p>
    <?php endif; ?>
    <hr>
    <h2>Baggage Information</h2>
    <p>Select the flights you would like to upgrade:</p>
    <form action="" method="post">
        <?php
        // Fetch bookings with FastPassStatus as false
        $sql = "SELECT * FROM bookings WHERE FastPassStatus = 'False'"; // Assuming 'FastPassStatus' is the column name
        $result = mysqli_query($connection, $sql);

        // Display checkboxes for each booking with FastPassStatus as false
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<label>';
            echo "<input type='checkbox' name='booking[]' value='" . $row['ticketNumber'] . "'>";
            // Fetch passenger details based on PassengerID
            $passengerID = $row['PassengerID'];
            $passengerQuery = "SELECT FirstName, LastName FROM passengers WHERE PassengerID = '$passengerID'";
            $passengerResult = mysqli_query($connection, $passengerQuery);
            $passengerRow = mysqli_fetch_assoc($passengerResult);

            // Display FirstName and LastName
            echo ' Booking ID: ' . $row['ticketNumber'] . ', Passenger: ' . $passengerRow['FirstName'] . ' ' . $passengerRow['LastName'];
            echo '</label><br>';
        }
        ?>
        <hr>
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
        <input type="submit" value="Pay Now">
    </form>
    </div>
</body>
</html>
