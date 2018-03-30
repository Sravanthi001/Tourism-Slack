<?php
   include('session.php');
  ob_start();	//will turn output buffering on ie active no output is sent from the script (other than headers)
  
 //to retrieve channel names
  $sql = 'SELECT * FROM channels';
  $retval = mysqli_query($db,$sql);
  
  if(! $retval ) {
      die('Could not get data: ');
   }
 
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Slack for Tourism</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="css/chat-style.css">
  </head>
  <body>
    <div class="header">
      <div class="team-menu">Tourism</div>
      <div class="channel-menu"><span class="channel-menu_name"><span class="channel-menu_prefix">#</span>Amusement Parks</span></div>
    </div>
    <div class="main">
      <div class="listings">
        <div class="listings_channels">
          <h2 class="listings_header">Channels</h2>
          <ul class="channel_list">
            <?php
		  //display channel-list on webpage
			  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
				  
		  ?>
		  <li class="channel"><a class="channel_name"><span class="read"></span><span><span class="prefix">#</span><a style="color: white; text-decoration:none;" href=get-messages.php?id=<?php echo $row['channel_id']; ?> ><?php echo $row['channel_name']; ?></span></a></li>           
		   <?php 
		   }
		  ?>
          </ul>
        </div>
        <div class="listings_direct-messages">
          <h2 class="listings_header">Direct Messages</h2>
          <ul class="channel_list">
          </ul>
        </div>
      </div>
      <div class="message-history">
	  
		<?php
	      //display all messages on chat window in reverse order
			$result = mysqli_query($db,"SELECT * FROM messages where channel_id= 1 ORDER BY STR_TO_DATE(`timestamp`,'%Y-%m-%d %H:%i:%s')");

			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		?>
			<div class="message"><a class="message_profile-pic" href=""></a><a class="message_username" href=""><?php echo $row['username']; ?></a><span class="message_timestamp"><?php echo date('M j Y g:i A', strtotime($row['timestamp'])); ?></span><span class="message_star"></span><span class="message_content"><?php echo $row['message']; ?></span></div>
		<?php 
			}
		?>
       </div>
    </div>
    <div class="footer">
      <div class="user-menu"><span class="user-menu_profile-pic"></span><span class="user-menu_username"><?php echo $login_session; ?></span><span class="connection_status"><a style="color: #ab9ba9; text-decoration:none;" href="logout.php">Logout</a></span></div>
      <div class="input-box">
		<form method="post" name="input" action=" " >
        <input name="message" class="input-box_text" type="text"/>
		
		<?php
		//insert messages posted from text box to mysql database.
		date_default_timezone_set('America/New_York');
		//access channel_id
		//echo date("l jS \of F Y h:i:s A") . "<br>";
		
		$date = date('Y-m-d H:i:s');
		
		if(isset($_POST["message"])){
				$sql = "INSERT INTO messages (channel_id, username, timestamp, message)
				VALUES (1,'".$login_session."','".$date."','".addslashes(htmlspecialchars($_POST["message"]))."')";
		
			if ($db->query($sql) === TRUE) {
		//	echo "New record created successfully";
			} else {
		//	echo "Error: " . $sql . "<br>" . $db->error."";
			}
			header("Refresh: 0");
			exit;
		}
		?>
		
		</form>
      </div>
    </div>
  </body>
</html>
