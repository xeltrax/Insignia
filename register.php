<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/reg.css">
</head>
<body>
    <div class="container">
        <div class="log">
            <div class="head1">
                <h1>Pitchfork</h1>
            </div>
            <div class="head2">
                <h2>Welcome</h2>
            </div>
            <div class="head3">
                <h5>Join the Community Today.</h5><br>
            </div>
            <a href="login.php">Login</a>
            <label>Already have an Account?</label>
        </div>


        <div class="sign">
            <form action="register.php" method="POST">
                <div class="create">
                    <h2>Create your account</h2>
                </div>
                    <div class="name">
                        <div class="name2">
                        <input type="text" name="reg_fname" id="first" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){
                            echo $_SESSION['reg_fname'];
                        } ?>" autocomplete="off" required autofocus>

                        <input type="text" name="reg_lname" id="second" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){
                            echo $_SESSION['reg_lname'];
                        } ?>" autocomplete="off" required>
                        </div>
                    </div>

        <input type="email" name="reg_email" id="" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){
            echo $_SESSION['reg_email'];
        } ?>" autocomplete="off" required>
        <input type="password" name="reg_password" id="" placeholder="Password" autocomplete="off" required>
        <input type="password" name="reg_password2" id="" placeholder="Confirm Password" autocomplete="off" required>

        <input type="submit" name="sub" value="Signup">
        <label for="message" id="msg">
          <!--For displaying First Name error-->
          <?php
          if (in_array("Your First Name must be between 2 and 25 characters.<br>", $error)) {
              echo "Your First Name must be between 2 and 25 characters.<br>";}
              ?>
              <!--For displaying Last Name error-->
              <?php
              if (in_array("Your Last Name must be between 2 and 25 characters.<br>", $error)) {
                  echo "Your Last Name must be between 2 and 25 characters.<br>";}
                  ?>
                  <!--For displaying Email error-->
                  <?php
                  if (in_array("Email already in use<br>", $error)) {
                      echo "Email already in use<br>";} 
                      ?>
                      <!--For displaying Password error-->
                      <?php
                      if (in_array("Your password can contain only english characters or numbers.<br>", $error)) {
                          echo "Your password can contain only english characters or numbers.<br>";
                        }
                        else if (in_array("Password Does not match. <br>", $error)) {
                            echo "Password Does not match. <br>";}
                            else if (in_array("Your Password must have 8 to 11 characters.<br>", $error)) {
                                echo "Your Password must have 8 to 11 characters.<br>";}
                                ?>
        </label>
        <label for="success_msg" class="success">
             <!--For Displaying Account Successfull Message-->
             <?php
             if (in_array("<span>You're all set! Go ahead and Login! </span>", $error)) {
                 echo "<span>You're all set! Go ahead and Login! </span>";
                 // For redirecting Page after sometime
                  header( "refresh:3;url=login.php" );
                   exit();
                }
                ?>
        </label>
                               
        
            </form>
        </div>
    </div>
</body>
</html>
