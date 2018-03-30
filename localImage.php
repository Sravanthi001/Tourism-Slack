<?php
  // include("config.php");
    include('session.php');
   $error=' ';
   $errors = [' ',' ',' ',' ',' ',' ',' ',' '];
   if(isset($_POST['update_image']) && $_SERVER["REQUEST_METHOD"] == "POST"){
	   
	    $channel_id = intval($_GET['ch_id']);
		$imgFile = $_FILES['avatar']['name'];
		$tmp_dir = $_FILES['avatar']['tmp_name'];
		$imgSize = $_FILES['avatar']['size'];
	
		
		if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
			$error = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'msg_images/'; // upload directory
			
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			//$valid_extensions1 = array('txt','pdf','doc','html','php','sql'); 
			
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){   
				
				// rename uploading image
				$userpic = rand(1000,1000000).".".$imgExt;
			
				// Check file size '5MB'
				if($imgSize < 7000000)    {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
				 $errMSG = "Sorry, your file is too large.";
				 $error = "Sorry, your file is too large.";
				}
			}
			
			else{   
				$userpic = $imgFile;
				// Check file size '5MB'
				if($imgSize < 7000000)    {
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
				 $errMSG = "Sorry, your file is too large.";
				 $error = "Sorry, your file is too large.";
				}
			}
			
		  /* else{
			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; 
			$error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		   }*/
		}
	

		if(!isset($errMSG))
		{
			date_default_timezone_set('America/New_York');
			$date = date('Y-m-d H:i:s');
			$stmtSql = "INSERT INTO msg (channel_id, username, timestamp, message)
				VALUES ('".$channel_id."','".$login_session."','".$date."','".addslashes(htmlspecialchars($userpic))."')";
			//$stmtSql = "UPDATE users SET avatar='".$userpic."' WHERE username='". $user. "'";
			//echo $stmtSql;
			if ($db->query($stmtSql) === TRUE) {
				//echo "new record inserted";
				//header("refresh:5;profile.php?user=$user");
				$error = "File posted in the channel";
			}
			else{
				echo "error in inserting";
			}
			
		}
				
   }
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
		if($login_session == 'Admin'){
			header("location: adminchatPage.php?id=1&page=1");
		}
		else{
		header("location: chatPage.php?id=1&page=1");
		}
   }
   
?>

<html >
<head>
  <meta charset="UTF-8">
  <title>Slack for Tourism</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<script type="text/javascript" src= "https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/new-channel.css">
	<link rel="stylesheet" href="css/toggle-channel.css">
	<style>
	.thumb{
			display: block;
		margin: auto;
		height: 150px;
		width: 150px;
	}
	</style>
</head>

<body class="login-wrap">
  <div>
	<div class="login-html">
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Upload File</label>
		<div class="login-form">
			<div class="sign-up-htm">
				<form action = "" method = "post" enctype="multipart/form-data">
				<br></br>
					<div class="group">
						<input type="file" id="file-input" class="input" name="avatar" accept="image/*" />
				<br></br>
				
					</div>
					
					<div id="thumb-output"></div>
					
					<br><br>
					<div class="group">
							<input name="update_image" type="submit" class="button" value="Upload File">
						<br><br>
						<input name="Back" type="submit" class="button" value="Back">
						
						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error; ?></div>
					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 
<script type="text/javascript">
$(document).ready(function(){
    $('#file-input').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            $('#thumb-output').html(''); //clear html of output element
            var data = $(this)[0].files; //this file data
            
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                        $('#thumb-output').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
            
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
    });
});
</script> 
  
</body>
</html>
