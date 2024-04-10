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
        // Fetch the selected flight number from the form submission
        $selected_flight_number = $_POST['flightNumber'] ?? '';

        // Fetch booked seats for the selected flight from the database
        $sql_booked_seats = "SELECT bs.SeatNumber 
                             FROM bookings AS b
                             INNER JOIN available_seats AS bs ON b.SeatNumber = bs.SeatNumber
                             WHERE b.FlightNumber = '{$selected_flight_number}'";
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

        // Generate an array of available seats (you may need to customize this based on your total number of seats)
        $total_seats = range(1, 30);
        $available_seats = array_diff($total_seats, $booked_seats);
        ?>
        <div class="seatAssignment">
            <p class="p2">Select your seat assignment:</p>
            <div class="airplane">
                <?php
                foreach ($available_seats as $seat) {
                    echo "<div class='seat' id='seat$seat'>$seat</div>";
                }
                ?>
            </div>
        </div>
        <input type="submit" value="Continue">
    </form>
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

        form.addEventListener('submit', function (event) {
            if (!seatNumberInput.value) {
                alert('Please select a seat before continuing.');
                event.preventDefault(); // Prevent the form from submitting
            }
        });
    });
</script>
</body>
</html>
