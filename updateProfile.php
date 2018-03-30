<?php
	include('session.php');
	$error=' ';
	//$user= $_GET['user'];
	//echo $user;
	$sql = "SELECT fname, lname, username, email_id, avatar,gravatar,profile_flag FROM users where username ='".$login_session. "'";

	$retval = mysqli_query($db,$sql);
		  
		if(! $retval ) {
		  die('Could not get data: ');
	    }
	   $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
	   
	   
	/*   $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $row["email_id"] ) ) );
    $url .= "?s=50&d=404";*/
?>


<?php	   
	if(isset($_POST['update_profile']) && $_SERVER["REQUEST_METHOD"] == "POST"){
		
			$imgFile = $_FILES['avatar']['name'];
			$tmp_dir = $_FILES['avatar']['tmp_name'];
			$imgSize = $_FILES['avatar']['size'];
			
		
		if(empty($imgFile)){
			$errMSG = "Please Select Image File.";
			$error = "Please Select Image File.";
		}
		else
		{
			$upload_dir = 'avatar/'; // upload directory
			
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
			
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){   
    
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
			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
			$error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		   }
		}
	

		if(!isset($errMSG))
		{
			//$stmtSql = "INSERT INTO users (avatar) values ('".$userpic."') SELECT username FROM users WHERE username ='". $user. "' ";
			$stmtSql = "UPDATE users SET avatar='".$userpic."', profile_flag=0 WHERE username='".$login_session."'";
			//echo $stmtSql;
			if ($db->query($stmtSql) === TRUE) {
				//echo "new record inserted";
				header("location:updateProfile.php");
			}
			else{
				echo "error in inserting";
			}
			
		}
				
	}
	
	
	if(isset($_POST['use_gravatar']) && $_SERVER["REQUEST_METHOD"] == "POST"){
			$gravatar = $_POST['gravatar']; 
			echo $gravatar;
			
			$updateProfileFlg = "UPDATE users SET profile_flag=1 WHERE username='".$login_session."'";
			//echo $stmtSql;
			if ($db->query($updateProfileFlg) === TRUE) {
				//echo "new record inserted";
				header("location:updateProfile.php");
			}
			else{
				echo "error in inserting";
			}
	}
	
	if(isset($_POST['use_avatar']) && $_SERVER["REQUEST_METHOD"] == "POST"){
			$gravatar = $_POST['avatar']; 
			echo $gravatar;
			
			$updateProfileFlg = "UPDATE users SET profile_flag=0 WHERE username='".$login_session."'";
			//echo $stmtSql;
			if ($db->query($updateProfileFlg) === TRUE) {
				//echo "new record inserted";
				header("location:updateProfile.php");
			}
			else{
				echo "error in inserting";
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
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/profile/1css.css">
	<link rel="stylesheet" href="css/profile/button.css">
	<link rel="stylesheet" href="css/profile/bootstrap.min.css">
	<link rel="stylesheet" href="css/profile/font-awesome.min.css">
</head>

<body>
	<div class="container">
  <header>
  </header>
  <main>
  <form action = "" method = "post" enctype="multipart/form-data">
    <div class="row">
      <div class="left col-lg-4">
	  
        <div class="photo-left">
		<?php 
		//if ($url != "") { 
		//echo $url;
			
				$header_response = get_headers($row['gravatar'], 1);
			//	echo $url;
			//	echo $header_response[0]; 
				if($header_response[0]!== "HTTP/1.1 404 Not Found" && $row['profile_flag'] == 1)
				//	if ( strpos( $header_response[0], "404" ) !== true )
					{		
		?>
			<img class="photo" src="<?php echo htmlspecialchars($row['gravatar']); ?>" />
		<?php
				//	}
		}
			else
			{
				if (filter_var($row['avatar'], FILTER_VALIDATE_URL)) 
					{ 
									

						$header_response = get_headers($row['avatar'], 1);
						if ( strpos( $header_response[0], "404" ) !== true )
						{				
		?>
								
						<img class="photo" src="<?php echo htmlspecialchars($row['avatar']); ?>" />
						
		<?php
						}
					}else{
		?>
          <img class="photo" src="avatar/<?php echo $row['avatar']; ?>"/>
		  
		 <?php
				}
			}
			?>
        <!--  <div class="active"></div>-->
        </div>
        
		<h4 class="name"><?php echo $row['fname'];echo' '; echo $row['lname'];?></h4>
        
		<p class="info">Display Name: <?php echo $row['username'];?></p>
        
		<p class="info">Email Id: <?php echo $row['email_id'];?></p>
		
		
		
        <div class="stats row">
			<div class="stat col-xs-4" >
				<label for="user" class="number-stat">Change your avatar: </label>
				<br>
				
				<?php
				if($row['profile_flag'] == '0'){	
						?>
						<label class="label">You have selected Avatar</label><br>
						<input name="use_gravatar" type="submit" class="button1" value="Use Gravatar">
						
						<?php
							}
							else if($row['profile_flag'] == '1')
							{
								if($header_response[0]!== "HTTP/1.1 404 Not Found"){
								?>
								<label class="label">You have selected Gravatar</label><br>
								<input name="use_avatar" type="submit" class="button1" value="Use Avatar">
						<?php	
								}
								else{ 
						?>
								<label class="label">You don't have Gravatar</label><br>
						<?php	
								}		
							}
				?>
				<br></br>
				<input type="file" class="desc-stat" name="avatar" accept="image/*" />
				<br></br>
				<input name="update_profile" type="submit" class="button" value="Update Profile">
	      
	      			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
			</div>
         
        </div>
   
     <div class="social">
			<input name="Back" type="submit" class="button" value="Back">
      
        </div>
		
      </div>
	  </form>
  </main>
</div>
</body>

</html>


