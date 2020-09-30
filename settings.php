<?php

require "config/config.php";

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendors/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/set.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript">
		function showPreview(objFileInput) {
			hideUploadOption();
			if (objFileInput.files[0]) {
				var fileReader = new FileReader();
				fileReader.onload = function (e) {
					$("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
					$("#targetLayer").css('opacity','0.7');
					$(".icon-choose-image").css('opacity','0.5');
				}
				fileReader.readAsDataURL(objFileInput.files[0]);
			}
		}
		function showUploadOption(){
			$("#profile-upload-option").css('display','block');
		}

		function hideUploadOption(){
			$("#profile-upload-option").css('display','none');
		}

		function removeProfilePhoto(){
			hideUploadOption();
			$("#userImage").val('');
			$.ajax({
				url: "remove.php",
				type: "POST",
				data:  new FormData(this),
				beforeSend: function(){$("#body-overlay").show();},
				contentType: false,
				processData:false,
				success: function(data)
				{				
				$("#targetLayer").html('');
				setInterval(function() {$("#body-overlay").hide(); },500);
				},
				error: function() 
				{
				} 	        
			});
		}
		$(document).ready(function (e) {
			$("#uploadForm").on('submit',(function(e) {
				e.preventDefault();
				$.ajax({
					url: "upload.php?id=<?php echo $id;?>",
					type: "POST",
					data:  new FormData(this),
					beforeSend: function(){$("#body-overlay").show();},
					contentType: false,
					processData:false,
					success: function(data)
					{
					$("#targetLayer").css('opacity','1');
					setInterval(function() {$("#body-overlay").hide(); },500);
					},
					error: function() 
					{
					} 	        
			   });
			}));
		});
		</script>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>Pitchfork</h1>
        </div>
        <div class="navbar">
            <a href="mno.php"><i class="ion-home"></i></a> 
            <a href="search.php"><i class="ion-android-search"></i></a> 
            <a href="favorite"><i class="ion-android-favorite"></i></a> 
            <a href="message.php"><i class="ion-ios-paperplane"></i></a>
            <a href="#" class="active"><i class="ion-person"></i></a>
          </div>
    </nav>

    <section class="main">
        <div class="profile-section">
            <div class="abc">
			<div id="body-overlay"><div><img src="assets/img/loading.gif" width="64px" height="64px"/></div></div>
		<div class="bgColor">
			<form id="uploadForm" action="upload.php" method="post">
				 <div id="targetOuter">
					<div id="targetLayer"><?php if (file_exists("images/profile.jpg")){?><img src="images/profile.jpg" width="200px" height="200px" class="upload-preview" /><?php }?></div>
					<img src="assets/img/photo.png"  class="icon-choose-image"/>
					<div class="icon-choose-image" onClick="showUploadOption()"></div>
					<div id="profile-upload-option">
						<div class="profile-upload-option-list"><input name="userImage" id="userImage" type="file" class="inputFile" onChange="showPreview(this);"></input><span>Upload</span></div>
						<div class="profile-upload-option-list" onClick="removeProfilePhoto();">Remove</div>
						<div class="profile-upload-option-list" onClick="hideUploadOption();">Cancel</div>
					</div>
				</div>	
				<div>
				<input type="submit" value="Upload Photo" name="up" class="btnSubmit" onClick="hideUploadOption();"/>
				</div>
			</form>
		</div>
            </div>

            <div class="xyz">
                <form action="" method="POST">
                </form>
            </div>
        </div>
    </section>
</body>
</html>