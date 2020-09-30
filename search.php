<?php

require 'config/config.php';

$usid = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Pitchfork</h1>
        </div>
        
        <div class="navbar">
            <a href="mno.php?id=<?php echo $usid;?>"><i class="ion-home"></i></a> 
            <a class="active" href="#"><i class="ion-android-search"></i></a> 
            <a href="favorite.php?id=<?php echo $usid;?>"><i class="ion-android-favorite"></i></a> 
            <a href="message.php?id=<?php echo $usid;?>"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php?id=<?php echo $usid;?>"><i class="ion-person"></i></a>
          </div>

    </nav>

    <section class="main">
        <div class="sbar">
            <input type="hidden" id="carry" value="<?php echo $usid;?>"/>
            <input type="text" id="search" placeholder="Search"  autocomplete="off"/>
            <div id="display"></div>
        </div>
    </section>
</body>
</html>