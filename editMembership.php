<?php
 include('session.php');
 $getMembers = '';
 $selected_channel = '';
 if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getDetails"]) ) {
	 $selected_channel=$_POST['selected_channel'];
	 $getMembers = mysqli_query($db, "SELECT * from membership where channel_name='".$selected_channel."' AND username != 'Admin' ");
						
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
	<!--<link rel="stylesheet" href="css/reply-css.css">-->
	<script type="text/javascript" src= "https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/profile/button1.css">
	<link rel="stylesheet" href="css/editMember.css">
	
  </head>
  <body background="css/ch-background.jpg">
    <div class="main">

      <div class="message-history">
							
				<form action = "" method = "post">

					<input type="submit" class="button1" name="Back" value="Back"></input>
				</form>
			<div class="message">
				
			<!--	<div class="message">-->
				<form action = "" method = "post" id="formid">
						
				<div class="group">
						<label for="user" class="label">Channel List</label>
						
						<?php
							echo "<select name=\"selected_channel\" class=\"label\">";
							echo "<option>Select List</option>";
							$getChannels = mysqli_query($db, "SELECT channel_name from channels ");
						
							while($chRes = mysqli_fetch_array($getChannels, MYSQLI_ASSOC)) {
							echo "<option value='" . $chRes['channel_name'] . "'>" . $chRes['channel_name'] . "</option>";
							
						}
						echo "</select>";
						?>
					</div>
					<div class="group">
						<input name="getDetails" type="submit" class="button1" value="Get Details">
					</div>
					
					<br>
					<?php
					if($selected_channel != '' && $selected_channel != "Select List"){
					?>
					
					<h3>Selected channel: <?php echo $selected_channel; ?></h3>
					
					
					<?php
					}
					?>
					</br>
					<section>
						
						<div id="members" >
						<h3 align="center">Members</h3>
						</br>
						<?php
						if($selected_channel != '' && $selected_channel !="Select List"){
							while($chRes = mysqli_fetch_array($getMembers, MYSQLI_ASSOC)) {
								
						?>
						<div class="message_content" id=<?php echo $chRes['member_id']; ?>> <?php echo $chRes["username"]; ?> &nbsp;&nbsp;
						<input name="delete" type="submit" class="button1" value="Delete" id=<?php echo $chRes['member_id']; ?> onclick="removeMember(this);">
						<br></br>
						</div>
						<?php
							}
						}
						?>
						</div>
						
						
						<div id="nonmembers" >
						<h3 align="center">Non-Members</h3>
						</br>
						<?php
						if($selected_channel != '' && $selected_channel !="Select List"){
							$getNonmembers = mysqli_query($db,"SELECT username  FROM users WHERE users.username NOT IN (SELECT username FROM membership WHERE membership.channel_name='".$selected_channel." ')");
							while($nonmemsql = mysqli_fetch_array($getNonmembers, MYSQLI_ASSOC)){
									
								
							?>
							<div class="message_content" id=<?php echo $nonmemsql['username']; ?> > <?php echo $nonmemsql['username']; ?> &nbsp;&nbsp;
						<input name="add" type="submit" class="button1" value="Add" id=<?php echo $nonmemsql['username']; ?> onclick="addMember('<?php echo $selected_channel; ?>',this);">
						<br></br>
						</div>
						<?php
							}
							//}
							//}
						}
						?>
						</div>
					</section>
					<br>
					
				<div class="group">
					<?php
						if($selected_channel != ''){
							$getMembers = mysqli_query($db, "SELECT DISTINCT channel_type from membership where channel_name='".$selected_channel."' ");
							while($chRes = mysqli_fetch_array($getMembers, MYSQLI_ASSOC)) {
							if($chRes['channel_type'] == '0'){	
						?>
						<label for="user" class="label">Selected channel is public</label><br>
						<label for="user" class="label">Change it to private</label>
						<input name="makePrivate" type="submit" class="button1" value="Make Private" id=<?php echo $selected_channel; ?> onclick="makePrivateFun(this);">
						
						<?php
							}
							else if($chRes['channel_type'] == '1'){
								?>
								<label for="user" class="label">Selected channel is private</label><br>
								<label for="user" class="label">Change it to public</label>
								<input name="makePublic" type="submit" class="button1" value="Make Public" id=<?php echo $selected_channel; ?> onclick="makePublicFun(this);">
						<?php		
							}
						}
						}
						?>
				</div>	
					<br></br>
				<div>	
				<!--<input type="submit" class="button1" name="Accept" value="Accept" id=<?php //echo $invites['invite_id']; ?>></input>
				<input type="submit" class="button1" name="Decline" value="Decline" id=<?php //echo $invites['invite_id']; ?>></input>
				--></div>
				
				
			</form>
				
			
						
							
				</div>	
				
					<?php
						  
						   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
								header("location: adminchatPage.php?id=1&page=1");
						   }
					?>
	
			<script>
				function removeMember(removeButton){  
					
							 var remove_id = $(removeButton).attr('id');
							// echo remove_id;
							//return a;
						//	var d= {'remove_id':remove_id}
							$.ajax({
								type: "POST",
								url: 'removeMember.php',
								 data:{'remove_id':remove_id},
								dataType: 'json',
								success: function(data)
								{
								   alert('User is removed from the channel ');
								}
							});
						}
						
				function makePrivateFun(privateButton){  
					
							 var ch_type = $(privateButton).attr('id');
							console.log(ch_type);
							//return a;
						//	var d= {'remove_id':remove_id}
							$.ajax({
								type: "POST",
								url: 'changeChType.php',
								 data:{'ch_type':ch_type},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  alert('channel changed to private');
								}
							});
						}
						
				function makePublicFun(publicButton){  
					
							 var ch_type1 = $(publicButton).attr('id');
							//console.log(ch_type);
							
						//	var d= {'remove_id':remove_id}
							$.ajax({
								type: "POST",
								url: 'changeChType.php',
								 data:{'ch_type1':ch_type1},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  alert('channel changed to Public');
								}
							});
						}
						
				function addMember(channel_name,username){
						var username = $(username).attr('id');
							//console.log(channel_name);
							//alert(channel_name);
							
							var d= {'channel_name':channel_name,'username':username}
							$.ajax({
								type: "POST",
								url: 'removeMember.php',
								 data:d,
								dataType: 'json',
								success: function(data)
								{
								   alert(username + ' is added to the channel ' + channel_name);
								}
							});
						
					
				}
			</script>
		
       </div>
    </div>
  </body>
</html>
