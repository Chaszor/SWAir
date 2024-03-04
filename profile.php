<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('session.php');
//var_dump($result);  // Output the result for debugging
if (!$result) {
  die("Error executing booking query: " . $stmt_booking->error);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>SW Fast Air - Dashboard</title>
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
                <img src="Resources/images/SWFastAir.png" alt="SWFastAir" style="transform: translate(600px,-10px) scale(0.75);" >
        </div>
    <div class="navbar">
      <ul>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
    <h1 class="heading"><img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60">SW Fast Air Dashboard<img src="Resources/icons/HpIcon1_WhyFly_190305.png" width="60"></h1>
    <p class="dashboard">
      Welcome, <b><?php echo $first_name; ?></b><br>
    </p>
    <?php
      // Fetch booking information from the database
      $sql_booking = "SELECT * FROM bookings WHERE PassengerID = ?";
      $stmt_booking = $connection->prepare($sql_booking);
      $stmt_booking->bind_param("i", $passengerID);

      if (!$stmt_booking->execute()) {
        die("Error executing booking query: " . $stmt_booking->error);
      }

      $result_bookings = $stmt_booking->get_result();

      // Close the statement
      $stmt_booking->close();

      // Check if there are rows returned
      if ($result_bookings->num_rows > 0) {
      // Output data of each row
      echo "<div class='results'>";
      echo "<h2>Your Bookings:</h2>";
      echo "<table border='1' class='profileTable'>
              <tr>
                  <th>Ticket Number</th>
                  <th>Flight Number</th>
                  <th>Seat Number</th>
                  <th>FastPass Status</th>
              </tr>";

      while ($row_booking = $result_bookings->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row_booking['ticketNumber'] . "</td>
                  <td>" . $row_booking['FlightNumber'] . "</td>
                  <td>" . $row_booking['SeatNumber'] . "</td>
                  <td>" . $row_booking['FastPassStatus'] . "</td>
              </tr>";
      }
      echo "</table>";
      } else {
        // No bookings found
        echo "<p>No bookings found.</p>";
      }

      // Fetch booking information from the database
      $sql_booking = "SELECT * FROM bookings WHERE PassengerID = ?";
      $stmt_booking = $connection->prepare($sql_booking);
      $stmt_booking->bind_param("i", $passengerID);

      if (!$stmt_booking->execute()) {
        die("Error executing booking query: " . $stmt_booking->error);
      }

      $result_bookings = $stmt_booking->get_result();

      // Close the statement
      $stmt_booking->close();

      // Fetch checked baggage information from the database
      $sql_baggage = "SELECT * FROM checkedbags WHERE PassengerID = ?";
      $stmt_baggage = $connection->prepare($sql_baggage);
      $stmt_baggage->bind_param("i", $passengerID);

      if (!$stmt_baggage->execute()) {
        die("Error executing baggage query: " . $stmt_baggage->error);
      }

      $result_baggage = $stmt_baggage->get_result();

      // Close the statement
      $stmt_baggage->close();

      // Check if there are rows returned
      if ($result_baggage->num_rows > 0) {
        // Output data of each row
        echo "<h2>Your Checked Baggage:</h2>";
        echo "<table border='1' class='profileTable'>
                <tr>
                    <th>BagID</th>
                    <th>Ticket Number</th>
                    <th>Weight</th>
                    <th>Bag Status</th>
                    <th>Special Requests</th>
                </tr>";

        while ($row_baggage = $result_baggage->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row_baggage['BagID'] . "</td>
                    <td>" . $row_baggage['ticketNumber'] . "</td>
                    <td>" . $row_baggage['Weight'] . " lbs</td>
                    <td>" . $row_baggage['BagStatus'] . "</td>
                    <td>" . $row_baggage['SpecialRequests'] . "</td>
                </tr>";
        }

        echo "</table>";
      } else {
        // No baggage found
        echo "<p>No baggage found.</p>";
      }
    ?>
    <form action='clear_all.php' method='post'>
      <input type='submit' value='Click Here to Clear All Information'>
    </form>
    <br>
    <form class="upgrade" action="ticketUpgrade.php">
      <label><h3> To upgrade to Fast Air, we need<br> information regarding your ticket.</h3></label>
      <input type="submit" value="Click here to get started!" />
    </form>
    <br>
  </body>
</html>
