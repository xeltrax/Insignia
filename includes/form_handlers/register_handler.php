<?php

$error = array(); // For holding Error Messages

if (isset($_POST['sub'])) {

    // Registration form values

    //First Name
    $fname = strip_tags($_POST['reg_fname']); // For removing html tags
    $fname = str_replace(' ','',$fname); // For removing spaces
    $fname = ucfirst(strtolower($fname));  // For making First letter Capital
    $_SESSION['reg_fname'] = $fname;

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); // For removing html tags
    $lname = str_replace(' ','',$lname); // For removing spaces
    $lname = ucfirst(strtolower($lname));  // For making First letter Capital
    $_SESSION['reg_lname'] = $lname;

    //Email
    $em = strip_tags($_POST['reg_email']); // For removing html tags
    $em = str_replace(' ','',$em); // For removing spaces
    $_SESSION['reg_email'] = $em;

    //Password
    $password = strip_tags($_POST['reg_password']); // For removing html tags
    $password2 = strip_tags($_POST['reg_password2']);   // For Removing html tags

    $date = date("Y-m-d"); //Current date

    // Checking if email already exist
    $e_check = mysqli_query($con,"SELECT `Email` FROM users where `Email`='$em'");
    //Count the number of rows returned
    $num_rows = mysqli_num_rows($e_check);

    if ($num_rows > 0) {
        array_push($error,"Email already in use<br>");
    }

    if (strlen($fname)>25 || strlen($fname)<2) {
        array_push($error,"Your First Name must be between 2 and 25 characters.<br>");
    }

    if (strlen($lname)>25 || strlen($lname)<2) {
        array_push($error,"Your Last Name must be between 2 and 25 characters.<br>");
    }

    if ($password!=$password2) {
        array_push($error,"Password Does not match. <br>");
    }
    else{
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error,"Your password can contain only english characters or numbers.<br>");
        }
    }
    if (strlen($password>12 || strlen($password)<7)) {
        array_push($error,"Your Password must have 8 to 11 characters.<br>");
    }

    if (empty($error)) {
       // $password = md5($password); // Encrypt password before sending to the database

        // Generate username by concatenating first name and last name
        $username = strtolower($fname."_".$lname);
        $check_username_query = mysqli_query($con,"SELECT `Username` FROM users where `Username` = '$username'");

        $i = 0;
        // if the username exists add number to username
        while (mysqli_num_rows($check_username_query)!=0) {
            $i++; //Add 1 to i
            $username = $username."_".$i;
            $check_username_query = mysqli_query($con,"SELECT `Username` FROM users where `Username` = '$username'");
        }

        $query = mysqli_query($con,"INSERT into users(`First_name`,`Last_name`,`Username`,`Email`,`Password`) values('$fname','$lname','$username','$em','$password')");

        // For Clearing Session variables
        $_SESSION['reg_fname'] = '';
        $_SESSION['reg_lname'] = '';
        $_SESSION['reg_email'] = '';

        array_push($error,"<span>You're all set! Go ahead and Login! </span>");

    }

}
?>