<?php

require "config/config.php";

$mid = $_GET['id'];

$error = array(); // For Holding error messages

// Getting Username from users table
$get_name = mysqli_query($con,"SELECT `Username` from users where `Id`=$mid");
$name_res = mysqli_fetch_array($get_name);
$myname = $name_res['Username'];

// echo $myname;

// For Fetching Profile Photo of the User
$prof_direct = "profiles"."/".$myname."."."*"; // Profile Directory;
$openimages = glob($prof_direct);

$dp = array();
foreach($openimages as $image) {
    $dp = $image;
}

// For Retrieving Images from mysql Table
$direct = "users_data"."/".$myname."/";
$post_dis = mysqli_query($con,"SELECT * from `posts` where `user_id` = '$mid'");
$pic_id = array();
$allfile = array();
while ($f = mysqli_fetch_array($post_dis)) {
    if ($f!='..' && $f!='.') {
        $allfile[] = $f['post_name'];
        $pic_id[] = $f['id'];
    }
}

// For Deleting the post from the user data and table
if(isset($_POST['del'])){
    $pid = $_POST['post_id'];
    $pname = $_POST['post_name'];
    $post_del = $direct.$pname;
    $del_query = mysqli_query($con,"DELETE from `posts` where `id`='$pid'");
    $update_total_post = mysqli_query($con,"UPDATE users set `num_posts`=`num_posts`-1 where `Id`='$mid'");  
    unlink($direct.$pname);
    header("Location:Pictures.php?id={$mid}");
 }
 else{
     echo "";
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/pictures.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Posts</h1>
        </div>
    </nav>
    <div class="main">
    
                <?php
            if(isset($allfile)){
                $totalimages = count($allfile);
                $col = 3;
                $a = 0;
                $row = ceil($totalimages/3);
                $c = 0;
                for ($j=0; $j < $row; $j++) { 
                    echo "<tr>";
                    for ($i=0; $i <$col && $c<$totalimages; $i++) { 
                        $a++;
                        ?>
                        <div class="com-post">
                            <div class="post">
                                <div class="post-options">
                                    <div class="pic">
                                        <img src="<?php if(isset($dp))echo $dp;?>" alt="">
                                    </div>
                                    <label for="" class="person"><?php echo $myname; ?></label>
                                    <div class="dropdown" style="float: right;">
                                        <span><i class="ion-android-more-vertical"></i></span>
                                        <div class="dropdown-content">
                                            <form action="" method="POST">
                                                <input type="hidden" value="<?php echo $pic_id[$c]; //This Fetches Image id from Table?>" name="post_id">
                                                <input type="hidden" value="<?php echo $allfile[$c]; //This Fetches Image id from Table?>" name="post_name">
                                                <input type="submit" value="Delete" name="del">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="" method="POST" class="userpost">
                                    <input type="image" src="<?php echo $direct.$allfile[$c]; //This Fetches the image name from table?>" value="<?php echo $direct.$allfile[$c];?>" width="100%" height="445" name="delete_file">
                                </form>
                            </div>
                            <div class="post-detail">
                                <a><i class="ion-android-favorite" style="color:#E1306C;"></i><a>
                                    <a href=""><i class="ion-chatbubble-working"></i></a>
                                    <a href=""><i class="ion-android-share"></i></a>
                                    <a href=""><i class="ion-android-bookmark" style="float: right;"></i></a>
                            </div>
                        </div>
                        <?php
                        $c++;
                    }
                }
            }
            ?>
            
    </div>
</body>
</html>