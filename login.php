<?php

require 'config/config.php';
$msg = array();

// For submit button
if (isset($_POST['sub'])) {
    $email = $_POST['log_id'];
    $password = $_POST['log_pass'];
    if ($email !='' && $password !='') {
        $check_database_query = mysqli_query($con,"SELECT * FROM users WHERE `Email` = '$email' AND `Password` = '$password'"); 
        $check_login_query = mysqli_num_rows($check_database_query);
        $row = mysqli_fetch_assoc($check_database_query);
        if($check_login_query>0) {
            $_SESSION['uid'] = $row['Id'];
            $direc_name = $row["Username"];
            $direct = "users_data"."/".$direc_name."/";
            mkdir("$direct");
            header("Location:mno.php");
            exit();
        }
        else {
            array_push($msg,"Invalid Email or Password!");
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link rel="stylesheet" href="assets/css/style_log.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>
<body>
    <div class="logo">
        <h1 id="logo-name">Insignia</h1> 
    </div>
    <div class="log">
        <form action="login.php" method="POST">
            <h1>Login</h1>
            <input type="email" name="log_id" placeholder="Email" autocomplete="off" autofocus required>
            <input type="password" name="log_pass" placeholder="Password" required>
            <input type="submit" name="sub" value="Login">
            <label for="" class="lb">Don't have an Account?</label><br>
            <center><a href="register.php" class="sign">Signup</a></center>
            <label for="" class="error">
            <?php 
            if(in_array("Invalid Email or Password!",$msg)){ 
                echo "Invalid Email or Password!";
            }
            elseif (in_array("",$msg)) {
                header("Location:mno.php");
            }
            ?>
            </label>
        </form>
    </div>
</body>
</html>