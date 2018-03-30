<?php
  // include("config.php");
    include('session.php');
   $error=' ';
   $errors = [' ',' ',' ',' ',' ',' ',' ',' '];
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["CreateCh"]) && isset($_POST['ch_type'])) {
	   
	//check with other channels from database   
	$check_channel = "SELECT channel_name FROM channels WHERE BINARY channel_name = BINARY '".addslashes(htmlspecialchars($_POST["nchannel"]))."'";
	$result = mysqli_query($db,$check_channel);
	if (mysqli_num_rows($result) != 0)
	{
		$errors[0] =  "Channel already exists, please give another name";
	}
	else{
	   $chName = $db->real_escape_string(htmlspecialchars($_POST['nchannel']));
	   $chType = htmlspecialchars($_POST['ch_type']);
	   
	   if( $chName == ""){
		   $error = "Please enter channel name";
	   }
	   else{
		$chsql = "INSERT INTO channels (channel_name, channel_type, channel_owner) "
                        . "VALUES ('$chName','$chType', '".$login_session."' )";	
                
                //if the query is successsful, redirect to welcome.php page, done!
                if ($db->query($chsql) === TRUE){
                    //$_SESSION['message'] = "Registration succesful! Added $username to the database!";
					$error = "Channel created";
                  //  header("location: chatPage.php");
                }
                else {
                    $errors[1] = 'channel could not be added to the database!';
                }
		
		//adding membership info in membership table
		$memsql = "INSERT INTO membership (channel_name, channel_type, username) "
                        . "VALUES ('$chName','$chType', '".$login_session."' )";	
		$db->query($memsql);
		
		if($login_session != 'Admin'){
		$adminsql = "INSERT INTO membership (channel_name, channel_type, username) "
                        . "VALUES ('$chName','$chType', 'Admin' )";	
		$db->query($adminsql);
		}
	   }
	}
   }
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
		//$usernameSql = mysqli_query($db,"SELECT username, avatar from users where username='".$login_session."'");
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
	<link rel="stylesheet" href="css/new-channel.css">
	<link rel="stylesheet" href="css/toggle-channel.css">
	
</head>

<body class="login-wrap">
  <div>
	<div class="login-html">
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Create a Channel</label>
		<div class="login-form">
			<div class="sign-up-htm">
				<form action = "" method = "post" autocomplete="off" enctype="multipart/form-data">
					<div class="group">
						<label for="user" class="label">Channel Type</label>	
						<input id="tab-1" type="radio" name="ch_type" value="0" checked="checked"><label for="tab-1">Public</label>
						<input id="tab-2" type="radio" name="ch_type" value="1"><label for="tab-2" >Private</label>
					</div>
					
					<div class="group">
						<label for="user" class="label">Channel Name</label>
						<input id="user" name="nchannel" type="text" class="input" >
					</div>
					
					<br><br>
					<div class="group">
						<input name="CreateCh" type="submit" class="button" value="Create channel">
						<br><br>
						<input name="Back" type="submit" class="button" value="Back">
						
						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[0]; ?></div>
						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[1]; ?></div>
						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error; ?></div>
					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
