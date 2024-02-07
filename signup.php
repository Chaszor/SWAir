<?php
error_reporting(0);

$Username=$_POST['username'];
$Password=$_POST['password'];
$con = mysql_connect("localhost", "root", "");

if(!$con){
    die('could not connect:'.mysql_error());
}
mysql_select_db("logindb", $con);

$query="INSERT INTO users(null,Username,Password) VALUES('$Username', '$Password')";
if(!mysql_query($query,$con)){
    die('Error in inserting records' .mysql_error);
    }else
    {
        echo "Account Created";
    }
?>