<?php
 include('session.php');
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
  </head>
  <body background="css/ch-background.jpg">
    <div class="main">

      <div class="message-history">
							
				<form action = "" method = "post">

					<input type="submit" class="button1" name="Back" value="Back"></input>
				</form>
			<div class="message">
				
					<?php
						$invitesql = mysqli_query($db,"SELECT * FROM invitation where receiver_name = '".$login_session."'");
						while($invites = mysqli_fetch_array($invitesql, MYSQLI_ASSOC)) {							
							
					?>
			<!--	<div class="message">-->
				<form action = "" method = "post">
				
				<div class="hover-message1" id=<?php echo $invites['invite_id']; ?> >
			
				<label class="message_content">You got invitation from <?php echo $invites["sender_name"]; ?> for the <?php echo $invites["channel_name"]; ?> channel</label>
				<br></br>
				<input type="submit" class="button1" name="Accept" value="Accept" id=<?php echo $invites['invite_id']; ?> onclick="f1(this)"></input>
				<input type="submit" class="button1" name="Decline" value="Decline" id=<?php echo $invites['invite_id']; ?> onclick="f2(this)"></input>
				
				
				
			</form>
				
				</div>
						<?php 

						}
					?>
							
				</div>	
				
					<script type="text/javascript" >
						/*$('input:image').click(function() {
							alert($(this).val());
						});
						style="float: right;" 
						*/
						
						function f1(objButton){  

						var notification_id = $(objButton).attr('id');
						//	alert (b);
							//var name = $("input:image").val();
							//alert (name);
							//return a;
						//	var d= {'vote':a, 'msg_id':msg_id}
							$.ajax({
								type: "GET",
								url: 'invitationaccept.php',
								 data:{'notification_id':notification_id},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								   alert(data);
								}
							});
						}
						
						function f2(declineButton){  

						var notification_id = $(declineButton).attr('id');
						//	alert (b);
							//var name = $("input:image").val();
							//alert (name);
							//return a;
						//	var d= {'vote':a, 'msg_id':msg_id}
							$.ajax({
								type: "GET",
								url: 'invitationdecline.php',
								 data:{'notification_id':notification_id},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								   alert(data);
								}

							});
						}
						
						</script>
				
				
					<?php
						  
						   
						   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
								if($login_session == 'Admin'){
									header("location: adminchatPage.php?id=1&page=1");
								}
								else{
								header("location: chatPage.php?id=1&page=1");
								}
						   }
					?>
	
		
       </div>
    </div>
  </body>
</html>
