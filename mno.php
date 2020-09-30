<?php
require "config/config.php";
$myid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Pitchfork</h1>
        </div>
        
        <div class="navbar">
            <a class="active" href="#"><i class="ion-home"></i></a> 
            <a href="search.php"><i class="ion-android-search"></i></a> 
            <a href="favorite.php"><i class="ion-android-favorite"></i></a> 
            <a href="message.php"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php?id=<?php echo $myid;?>"><i class="ion-person"></i></a>
          </div>
    </nav>

    <section class="main">
        <div class="com-post">
            <div class="post">
                <div class="post-options">
                    <div class="pic">
                        <img src="" alt="">
                    </div>
                    <label for="" class="person">Username</label>
                    <a href=""><i class="ion-android-more-vertical"></i></a>
                </div>
                <img src="" alt="retry">
            </div>
                <div class="post-detail">
                    <a href=""><i class="ion-android-favorite-outline"></i></a>
                    <a href=""><i class="ion-chatbubble-working"></i></a>
                    <a href=""><i class="ion-android-share"></i></a>
                    <a href=""><i class="ion-android-bookmark" style="float: right;"></i></a>
                    
                </div>
        </div>

        <div class="com-post">
            <div class="post">
                <div class="post-options">
                    <div class="pic">
                        <img src="" alt="">
                    </div>
                    <label for="" class="person">Username</label>
                    <a href=""><i class="ion-android-more-vertical"></i></a>
                </div>
                <img src="" alt="retry">
            </div>
                <div class="post-detail">
                    <a><i class="ion-android-favorite-outline"></i><a>
                    <a href=""><i class="ion-chatbubble-working"></i></a>
                    <a href=""><i class="ion-android-share"></i></a>
                    <a href=""><i class="ion-android-bookmark" style="float: right;"></i></a>
                </div>
        </div>

        <div class="com-post">
            <div class="post">
                <div class="post-options">
                    <div class="pic">
                        <img src="" alt="">
                    </div>
                    <label for="" class="person">Username</label>
                    <a href=""><i class="ion-android-more-vertical"></i></a>
                </div>
                <img src="" alt="retry">
            </div>
                <div class="post-detail">
                    <a href=""><i class="ion-android-favorite-outline"></i></a>
                    <a href=""><i class="ion-ios-chatbubble-outline"></i></a>
                    <a href=""><i class="ion-android-share"></i></a>
                    <a href=""><i class="ion-android-bookmark" style="float: right;"></i></a>
                </div>
        </div>
    </section>
</body>
</html>