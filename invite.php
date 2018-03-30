<?php
  // include("config.php");
    include('session.php');
   $error=' ';
   $errors = [' ',' ',' ',' ',' ',' ',' ',' '];
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SendInvite"]) ) {
	  
	  $selected_channel=$_POST['selected_channel'];
	   $selected_user=$_POST['selected_user'];
		
		
		$sql = "SELECT * FROM membership WHERE username = '$selected_user' AND channel_name = '$selected_channel'";
		  $result = mysqli_query($db,$sql);
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  $count = mysqli_num_rows($result);
		  
		  
		  $sql1 = "SELECT * FROM invitation WHERE receiver_name = '$selected_user' AND channel_name = '$selected_channel'";
		  $result1 = mysqli_query($db,$sql1);
		  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		  $count1 = mysqli_num_rows($result1);
		  // If result matched $myusername and $mypassword, table row must be 1 row
			echo $count;
		  if($count != 0) {
			  echo "in if";
			 //session_register("myusername");
			// $_SESSION['login_user'] = $myusername;
			 $error=" Selected user is already a member of a selected channel";
			// header("location: chatPage.php");
		  }
		  else if($count1 != 0){
		  
				$error = "User is already invited";
		  }
		  else if ($selected_user == "Select List" || $selected_channel == "Select List"){
			  
			  $error = "Please select both the fields";
		  }
		  else {
		  
		
		$inviteSql = "INSERT INTO invitation (channel_name, sender_name, receiver_name)
				VALUES ('".$selected_channel."','".$login_session."','".$selected_user."')";
			
			if ($db->query($inviteSql) === TRUE) {
			//echo "Invitation sent. New record created successfully";
			$error=" Invitation sent";
			} else {
			//echo "Error: " . $inviteSql . "<br>" . $db->error."";
			$error = "Error in inviting";
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
	<link rel="stylesheet" href="css/new-channel.css">
</head>

<body class="login-wrap">
  <div>
	<div class="login-html">
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Invite Members</label>
		<div class="login-form">
			<div class="sign-up-htm">
				<form action = "" method = "post" autocomplete="off" enctype="multipart/form-data">
					
					<div class="group">
						<label for="user" class="label">Channel List</label>
						
						<?php
							echo "<select name=\"selected_channel\" class=\"label\">";
							echo "<option>Select List</option>";
							$getChannels = mysqli_query($db, "SELECT channel_name from channels where channel_type='0' OR channel_owner='".$login_session."' ");
						
							while($chRes = mysqli_fetch_array($getChannels, MYSQLI_ASSOC)) {
							echo "<option value='" . $chRes['channel_name'] . "'>" . $chRes['channel_name'] . "</option>";
							
						}
						echo "</select>";
						?>
					</div>
					<div class="group">
						<label for="user" class="label">Send invites to:</label>
						<?php
							echo "<select name=\"selected_user\" class=\"label\">";
							echo "<option>Select List</option>";
							$getUsers = mysqli_query($db, "SELECT username from users where username!='".$login_session."' ");
						
							while($userRes = mysqli_fetch_array($getUsers, MYSQLI_ASSOC)) {
							echo "<option value='" . $userRes['username'] . "'>" . $userRes['username'] . "</option>";
							
							
						}
						echo "</select>";
						?>
					</div>
					<br><br>
					<div class="group">
						<input name="SendInvite" type="submit" class="button" value="Send Invitation" >
						<br><br>
						
						<input name="Back" type="submit" class="button" value="Back">
						

						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error; ?></div>
					
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
