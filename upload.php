<?php

require "config/config.php";

$id = $_GET['id']; // For Getting the UserName

$get_name = mysqli_query($con,"SELECT * from users where `Id`=$id");
$name_res = mysqli_fetch_assoc($get_name);
$myname = $name_res['Username'];


$error = array(); // For Holding error messages


if(is_array($_FILES)) {
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
		$sourcePath = $_FILES['userImage']['tmp_name'];
		$extension = explode("/", $_FILES["userImage"]["type"]);
		$targetPath = "profiles"."/".$myname."."."$extension[1]";
		$img_name = $myname."."."$extension[1]";
		$img_query = mysqli_query($con,"UPDATE users set `profile_pic`= '$targetPath',`profile_name`= '$img_name' where `Username`= $my_name");
		if(move_uploaded_file($sourcePath,$targetPath)) {
			header("Location:bio.php");	
?>
			<img src="<?php echo $targetPath; ?>" width="200px" height="200px" class="upload-preview" />
<?php
		}
	}
}
?>