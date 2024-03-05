<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('employee_session.php');
//var_dump($result);  // Output the result for debugging

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Curt Bennett">
    <meta name="description" content="">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Profile</title>
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
            <li><a href="home.html">Home</a></li>
            <!-- Add more menu items based on your application's structure -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <h1 class="heading">Employee Profile</h1>

    <div class="profile-info">
        <div class="empDash">
            <p><strong>Employee ID:</strong> <?php echo $employeeData['employeeID']; ?></p>
            <!-- Add more details based on your employee database structure -->
            <p><strong>Name:</strong> <?php echo $employeeData['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $employeeData['email']; ?></p>
            <!-- Add more details as needed -->
        </div>
        <br>
        
        <div class="search-form">
            <h3>Passenger Search</h3>
            <form action="search_passenger.php" method="GET">
                <label for="passengerEmail">Search Passenger by Email:</label>
                <input type="text" name="passengerEmail" id="passengerEmail" required>
                <button type="submit">Search</button>
            </form>
        </div>
        <br>
        <div class="upgrade-ticket">
            <h3>Upgrade a Ticket</h3>
            <form action="employee_ticket_upgrade.php" method="GET">
                <label for="ticketNumber">Enter Ticket Number to Upgrade</label>
                <input type="text" name="ticketNumber" id="ticketNumber" required>
                <button type="submit">Upgrade</button>
            </form>
        </div>
        <!-- You can customize the profile information based on your database structure -->
    </div>
</body>
</html>
