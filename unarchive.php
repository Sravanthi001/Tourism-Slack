<?php
  // include("config.php");
    include('session.php');
   $error=' ';
   $errors = [' ',' ',' ',' ',' ',' ',' ',' '];
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UnrchiveCh"]) ) {
	  
	  $selected_channel=$_POST['selected_channel'];
	//   $selected_user=$_POST['selected_user'];
		
		$sql1 = "SELECT channel_id FROM archive WHERE channel_name = '$selected_channel'";
		  $result1 = mysqli_query($db,$sql1);
		  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		  $count1 = mysqli_num_rows($result1);
		  $ch_id = $row1['channel_id'];	
		
		$sql = "DELETE FROM archive WHERE channel_id = '$ch_id'";
		  $result = mysqli_query($db,$sql);
		//  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  //$count = mysqli_num_rows($result);
		  
		  
		/*  $sql1 = "SELECT * FROM invitation WHERE receiver_name = '$selected_user' AND channel_name = '$selected_channel'";
		  $result1 = mysqli_query($db,$sql1);
		  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		  $count1 = mysqli_num_rows($result1);*/
		  // If result matched $myusername and $mypassword, table row must be 1 row
		/*	echo $count;
		  if($count == 0) {
				$archiveSql = "INSERT INTO archive (channel_id,channel_name) VALUES ('".$ch_id."','".$selected_channel."')";
			
			if ($db->query($archiveSql) === TRUE) {
			
				$error=" Channel is archived";
			} else {
			
				$error = "Error in archiving";
			}
			 
			
		  }*/
		 if ($selected_channel == "Select List"){
			  
			  $error = "Please select the field";
		  }
		  else {
		  
				//$error=" Selected channel is already archived";
			$error=" Selected channel is unarchived";
		  }	
				
   }
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
		header("location: adminchatPage.php?id=1&page=1");
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
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Unarchive channel</label>
		<div class="login-form">
			<div class="sign-up-htm">
				<form action = "" method = "post" autocomplete="off" enctype="multipart/form-data">
					
					<div class="group">
						<label for="user" class="label">Channel List</label>
						
						<?php
							echo "<select name=\"selected_channel\" class=\"label\">";
							echo "<option>Select List</option>";
							$getChannels = mysqli_query($db, "SELECT channel_name from archive ");
						
							while($chRes = mysqli_fetch_array($getChannels, MYSQLI_ASSOC)) {
							echo "<option value='" . $chRes['channel_name'] . "'>" . $chRes['channel_name'] . "</option>";
							
						}
						echo "</select>";
						?>
					</div>
					
					<br><br>
					<div class="group">
						<input name="UnrchiveCh" type="submit" class="button" value="Unarchive Channel" >
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
