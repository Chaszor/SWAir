<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include('session.php');

// Check if a booking ID is provided in the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingID = $_POST['booking_id'];

    // Use a prepared statement to fetch the booking details
    $connection = mysqli_connect("localhost", "root", "", "logindb");
    $sql = "SELECT * FROM bookings WHERE ticketNumber = ? AND FastPassStatus = 'true'";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $bookingID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Booking has a valid fast pass
            $message = "Booking with ID $bookingID has a valid fast pass.";
            $messageClass = "success";
        } else {
            // Booking does not have a valid fast pass
            $message = "Booking with ID $bookingID does not have a valid fast pass.";
            $messageClass = "error";
        }
    } else {
        // Error executing the query
        $message = "Error executing query: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
//mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Home</title>
    <link rel="icon" type="image/x-icon" href="Resources/images/favicon.ico">
  </head>
  <body>
  <style>
            body {
              background-image: url('Resources/images/hphero-geo-MBS-bkg-20240227.jpg');
              background-repeat: no-repeat;
              background-attachment: local;
              background-size:contain;
            }
            </style>
    <img src="Resources/images/SWFastAir.png" alt="SWFastAir">
    <div class="navbar">
      <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="verification.php">Verification</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.html">Sign Up</a></li>
        <li><a href="employee_login.php">Employee Login</a></li>
      </ul>
    </div>
    <h1 class="heading"><img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">Fast Air Verification<img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60"></h1>
    
    <br>
    

    <form method="post" align="center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="booking_id">Enter Booking ID:</label>
        <input type="text" name="booking_id" id="booking_id" required>
        <input type="submit" value="Verify">
    </form>

    <?php
    // Display the verification message if available
    if (isset($message)) {
        echo "<p class='$messageClass'>$message</p>";
    }
    ?>
</body>
</html>
