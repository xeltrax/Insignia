<?php

// Turns on output buffering
ob_start(); 

// For saving Variable Values
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata");

// For DataBase Connection
$con = mysqli_connect("localhost","root","","social");  

if (mysqli_connect_errno()) {
	echo "Failed to connect:". mysqli_connect_errno();
}
?>
