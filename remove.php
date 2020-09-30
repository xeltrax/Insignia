<?php	
require "config/config.php";

$name = $_SESSION['uname']; //Printing the user name of the person

$error = array(); // For Holding error messages

//For the Directory of the user
$direc_name = $name;
$direct = "users_data"."/".$direc_name."/";
$profile_direc = 0;

if (count(glob("profiles/*")) === 0 ) {		
	} else {
		unlink("profiles"."/".$_SESSION['uname']."."."*");
	}											
?>