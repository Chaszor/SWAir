<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('session.php');

// Fetch available flights from the database
$sql_flights = "SELECT FlightNumber, DepartureAirport, ArrivalAirport FROM flights";
$result_flights = mysqli_query($connection, $sql_flights);

// Check for query execution success
if (!$result_flights) {
    die("Error executing flights query: " . mysqli_error($connection));
}

// Fetch booked seats for the selected flight from the database
if (isset($_POST['flightNumber']) && !empty($_POST['flightNumber'])) {
    $selected_flight_number = $_POST['flightNumber'];
    $sql_booked_seats = "SELECT SeatNumber FROM bookings WHERE FlightNumber = '$selected_flight_number'";
    $result_booked_seats = mysqli_query($connection, $sql_booked_seats);

    // Check for query execution success
    if (!$result_booked_seats) {
        die("Error executing booked seats query: " . mysqli_error($connection));
    }

    // Extract booked seats from the result set
    $booked_seats = [];
    while ($row_booked_seats = mysqli_fetch_assoc($result_booked_seats)) {
        $booked_seats[] = $row_booked_seats['SeatNumber'];
    }
} else {
    $booked_seats = [];
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

<div class="ticketform">
    <form action="process_ticket.php" method="post" align="center">
        <label for="flightNumber">Select a Flight:</label>
        <select name="flightNumber" id="flightNumber">
            <?php
            echo "<option value=''>Select a Flight</option>";
            while ($row_flight = mysqli_fetch_assoc($result_flights)) {
                echo "<option value='{$row_flight['FlightNumber']}'>
                        {$row_flight['FlightNumber']} - {$row_flight['DepartureAirport']} to {$row_flight['ArrivalAirport']}
                    </option>";
            }
            ?>
        </select><br>
        <label for="ticketNumber">Enter your Ticket #:</label>
        <input type="number" id="ticketNumber" name="ticketNumber" required><br>
        <input type="hidden" id="passengerID" name="passengerID" value="<?php echo $passengerID; ?>">
        <input type="hidden" id="seatNumber" name="seatNumber">
        <?php
        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Fetch the selected flight number from the form submission
            $selected_flight_number = $_POST['flightNumber'] ?? '';

            // Fetch booked seats for the selected flight from the database
            $sql_booked_seats = "SELECT SeatNumber FROM bookings WHERE FlightNumber = '$selected_flight_number'";
            $result_booked_seats = mysqli_query($connection, $sql_booked_seats);

            // Check for query execution success
            if (!$result_booked_seats) {
                die("Error executing booked seats query: " . mysqli_error($connection));
            }

            // Extract booked seats from the result set
            $booked_seats = array();
            while ($row_booked_seats = mysqli_fetch_assoc($result_booked_seats)) {
                $booked_seats[] = $row_booked_seats['SeatNumber'];
            }
        } else {
            // If the form has not been submitted, initialize $booked_seats as an empty array
            $booked_seats = array();
        }
        
        ?>

        <div class="seatAssignment">
            <p class="p2">Select your seat assignment:</p>
            
            <div class="airplane">
    <?php
    // Generate an array of available seats (you may need to customize this based on your total number of seats)
    $total_seats = range(1, 30);
    foreach ($total_seats as $seat) {
        $seatClass = in_array($seat, $booked_seats) ? 'seat booked' : 'seat';
        echo "<div class='$seatClass' data-seat-number='seat$seat' id='seat$seat'>$seat</div>";
    }
    ?>
</div>
        </div>
        <input type="submit" value="Continue">
    </form>
    <br>
</div>

<?php
// Close the database connection
mysqli_close($connection);
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const seats = document.querySelectorAll('.seat');
        const seatNumberInput = document.getElementById('seatNumber');
        const form = document.querySelector('form');
        const fNumber = document.getElementById('flightNumber');

        seats.forEach(seat => {
            seat.addEventListener('click', function () {
                seats.forEach(otherSeat => {
                    if (otherSeat !== seat && otherSeat.classList.contains('selected')) {
                        otherSeat.classList.remove('selected');
                    }
                });
                seat.classList.toggle('selected');
                seatNumberInput.value = seat.classList.contains('selected') ? seat.id : '';
            });
        });
        document.getElementById('flightNumber').addEventListener('change', function() {
    // Get the current flight number from the input field
    var flightNumber = this.value;

    // Clear the 'booked' class from all seats first
    document.querySelectorAll('.airplane .seat').forEach(function(seat) {
        seat.classList.remove('selected');
        seat.classList.remove('booked');
        seat.onclick = null; // Remove any previous click handlers
    });

    // Only proceed if flightNumber is not empty
    if (flightNumber) {
        // Create a new AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetchSeats.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            // Check if the request was successful
            if (this.status == 200) {
                // Parse the JSON response containing the seat numbers
                var seats = JSON.parse(this.responseText);

                // Apply the 'booked' class to each returned seat and disable clicking
                seats.forEach(function(seat) {
                    var seatElement = document.querySelector('.airplane .seat[data-seat-number="' + seat + '"]');
                    if (seatElement) {
                        seatElement.classList.add('booked');
                        seatElement.onclick = function(event) {
                            event.preventDefault(); // Prevent interaction with this element
                        };
                    }
                });
            }
        };
        // Send the flight number to the server
        xhr.send('flightNumber=' + encodeURIComponent(flightNumber));
    }
});



        form.addEventListener('submit', function (event) {
            if (!fNumber){
                alert('Please select a flight number');
                event.preventDefault(); // Prevent the form from submitting
            }
            if (!seatNumberInput.value) {
                alert('Please select a seat before continuing.');
                event.preventDefault(); // Prevent the form from submitting
            }
        });
    });
</script>
</body>
</html>
