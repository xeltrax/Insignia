<?php

require "config/config.php";

$followerid = $_GET['id']; // For the Follower id

$userid = $_SESSION['uid'];

// For Fetching Username from database
$user_query = mysqli_query($con,"SELECT `Username` from users where `Id`='$userid'");
$us_result = mysqli_fetch_array($user_query);
$user_name = $us_result['Username'];

// For Fetching Number of Posts
$num_of_post = mysqli_query($con,"SELECT * FROM `posts` where `user_id`='$userid'");
$total_post_result = mysqli_num_rows($num_of_post);
$total_post = $total_post_result;

// For Fetching the Number Of Followers
$Follower_query = mysqli_query($con,"SELECT * from followers where `user_id`='$userid' AND `follower_id`='$followerid'");
$num_of_followers = mysqli_num_rows($Follower_query);

// For Fetching the Number Of Followers
$Following_query = mysqli_query($con,"SELECT * from followers where `user_id`='$userid'");
$num_of_following = mysqli_num_rows($Following_query);

$prof_direct = "profiles"."/".$user_name."."."*"; // Profile Directory;
$openimages = glob($prof_direct);

$dp = array();
foreach($openimages as $image) {
    $dp = $image;
}

//For the Directory of the user
$direc_name = $user_name;
$direct = "users_data"."/".$direc_name."/";

// For Openinng directory
$h = opendir($direct);
$allfile = array();
while ($f=readdir($h)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f;
    }
}
    closedir($h);

    // For Follow and unfollow
    $isFollowing = False;
    $msg = array();
    if (isset($_POST['follow'])) {
        $check_query = mysqli_query($con,"SELECT * from followers Where `user_id`='$userid' AND `follower_id`='$followerid'");
        $check_result = mysqli_num_rows($check_query);
            if ($check_result ==0) {
                $query2 = mysqli_query($con,"INSERT INTO followers(`user_id`,`follower_id`,`status`) VALUES('$userid','$followerid',1)");
                echo 'Started Following';
            }
            else{
                array_push($msg,"Already Following!.<br>");
            }
        $isFollowing = True;
    }
    
    if (isset($_POST['unfollow'])) {
        $check2_query = mysqli_query($con,"SELECT * from followers Where `user_id`='$userid' AND `follower_id`='$followerid'");
        $check2_result = mysqli_num_rows($check2_query);
            if ($check2_result> 0) {
                $query4 = mysqli_query($con,"DELETE FROM followers WHERE `user_id`='$userid' AND `follower_id`='$followerid'");
                echo 'Unfollowed the user';
            }
            $isFollowing = False;        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searched Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Pitchfork</h1>
        </div>
        
        <div class="navbar">
            <a href=""><i class="ion-home"></i></a> 
            <a href="search.php"><i class="ion-android-search"></i></a> 
            <a href="favorite.php"><i class="ion-android-favorite"></i></a> 
            <a href="message.php"><i class="ion-ios-paperplane"></i></a>
            <a href="bio.php"><i class="ion-person"></i></a>
          </div>
    </nav>

    <section class="main">
        <!--For Profile Photo,Likes ,Followers,Following etc.-->
        <div class="bio-container">
            <div class="profile-container">
                <div class="profile-photo">
                    <img src="<?php if(isset($dp)){
                        echo $dp;
                    }?>" alt=""  width="100%" height="140" style="border-radius:50%">
                    
                </div>
            </div>
            <div class="bio-details">
                <div class="dropdown" style="float: right;">
                    <button class="dropbtn" onclick="myFunction()">
                        <span class="setting"><i class="ion-android-settings"></i></span>
                    </button><br>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="settings.php"><i class="ion-settings"></i> Settings</a>
                        <a href="includes/form_handlers/logout.php"><i class="ion-log-out"></i> Logout</a>
                    </div>
                    <br>
                </div>
                
                <div class="bio-name">
                    <span><?php echo $user_name; ?></span>
                </div>

                <div class="strength">
                    <span><?php echo $total_post;?>Post</span>
                    <span><?php echo $num_of_followers;?>Followers</span>
                    <span><?php echo $num_of_following;?>Following</span>
                </div>
                <form action="" method="post">
                    <?php
                        if ($isFollowing) {
                            echo '<input type="submit" name="unfollow" value="Unfollow" class="followbtn">';
                        }else{
                            echo '<input type="submit" name="follow" value="Follow" class="followbtn">';
                        }
                    ?>
                </form>
            </div>
        </div> 

        <div class="posts-container">
        <?php
        if(isset($allfile))
            {
            $totalimages = count($allfile);
            $col = 3;
            $row = ceil($totalimages/3);
            $c = 0;
            for ($j=0; $j < $row; $j++) { 
                echo "<tr>";
                for ($i=0; $i <$col && $c<$totalimages; $i++) { 
                    ?>
                    <div class="post"><img src="<?php echo $direct. $allfile[$c];?>" width="100%" height="230"></div>
                    <?php
                    $c++;
                }
            }
    
        }
          
            ?>
        </div>
    </section>
    <script>
        function myFunction(){
            document.getElementById("myDropdown").classList.toggle("show");
        }
        window.onclick = function(event)
        {
            if(!event.target.matches('.dropbtn')){
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for(i=0;i<dropdowns.length;i++){
                    var openDropdown = dropdowns[i];
                    if(openDropdown.classList.contains('show')){
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>