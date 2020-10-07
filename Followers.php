<?php

require "config/config.php";
$myid = $_GET['id'];

// For fetching the Followers from the table
$following_query = mysqli_query($con,"SELECT followers.`user_id`,users.* from `followers` JOIN `users` ON followers.`user_id`= users.`Id` where `user_id` = '$myid'");
$following_profile = array();
$following_names = array();
while ($f = mysqli_fetch_array($following_query)) {
        $following_id[] = $f['user_id'];
        $following_names[] = $f['Username'];
        $following_profile[] = $f['profile_pic'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insignia</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/follow.css">
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Following</h1>
        </div>
    </nav>

    <section class="main">
        <?php

        if (isset($following_names)) {
            $total = count($following_names);
            $c = -1;
            for ($i=0; $i<$total; $i++) { 
                $c++;
                ?>
                <div class="following-details">
                    <div class="following-profile">
                         <div class="photo">
                            <img src="<?php echo $following_profile[$c];?>" alt="">
                        </div>
                    </div>
                    <div class="username">
                        <h2><?php echo $following_names[$c];?></h2>
                    </div>
                    <div class="option">
                        <form action="" method="post">
                            <input type="submit" value="Unfollow" name="unfollow" class="unfo">
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
</body>
</html>