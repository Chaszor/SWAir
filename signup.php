<?php
error_reporting(0);

$email=$_POST['email'];
$Password=$_POST['password'];
$name=$_POST['name'];
$con = mysql_connect("localhost", "root", "");

if(!$con){
    die('could not connect:'.mysql_error());
}
mysql_select_db("logindb", $con);

$query="INSERT INTO users(Email,Password,Name) VALUES('$email', '$Password', '$name')";
if(!mysql_query($query,$con)){
    die('Error in inserting records' .mysql_error);
    }else
    {
        echo "Account Created";
    }
?>

//INSERT INTO `users` (`AccountNumber`, `AccountType`, `Email`, `Password`, `Name`, `FlightDate1`, `FlightDate2`, `FlightDate3`, `SeatNumber1`, `SeatNumber2`, `SeatNumber3`, `CheckedBag1`, `CheckedBag2`, `CheckedBag3`) VALUES (NULL, '1', 'test2@gmail.com', '9876', 'Test Employee 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);