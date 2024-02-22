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
                // Fetch booked seats from the database
                $sql_booked_seats = "SELECT SeatNumber FROM bookings";
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
                        foreach ($total_seats as $seat) {
                            $isOccupied = in_array($seat, $booked_seats) ? 'occupied' : '';
                            echo "<div class='seat $isOccupied' id='seat$seat'>$seat</div>";
                        }
                        ?>
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
            if (!seat.classList.contains('occupied')) {
                seats.forEach(otherSeat => {
                    if (otherSeat !== seat && otherSeat.classList.contains('selected')) {
                        otherSeat.classList.remove('selected');
                    }
                });
                seat.classList.toggle('selected');
                seatNumberInput.value = seat.classList.contains('selected') ? seat.id : '';
                }
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
    