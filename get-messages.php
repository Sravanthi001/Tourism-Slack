<?php
   include('session.php');
   
  ob_start();
   
   $channel_id= $_GET['id'];
   
?>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Slack for Tourism</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="css/chat-style.css">
	<script type="text/javascript" src= "https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/profile/button1.css">
  </head>
  <body>
    <div class="header">
      <div class="team-menu">Tourism</div>
	  <?php
		$sql1 = 'SELECT channel_name FROM channels where channel_id =' .$channel_id;
		  $retval1 = mysqli_query($db,$sql1);
		  
		  if(! $retval1 ) {
			  die('Could not get data: ');
		   }
		   $row1 = mysqli_fetch_assoc($retval1)
	  ?>
      <div class="channel-menu"><span class="channel-menu_name"><span class="channel-menu_prefix">#</span><?php echo $row1['channel_name']; ?></span></div>
   
	</div>
    <div class="main">
      <div class="listings">
        <div class="listings_channels">
          <h2 class="listings_header">Channels
			  <span>
			  
			  <a style="color: white; text-decoration:none; margin-left: 6.0em;" href=addChannels.php >
			  
			  <img src="images/plus_add_green.png" alt="+" width="18" height="18" border="0">
			  </a></span>
		  </h2>
          <ul class="channel_list">
            <?php
			
				//to retrieve channel names
			  $sql = "SELECT * FROM membership where username='".$login_session."'";
			  $retval = mysqli_query($db,$sql);
			  while($getmembers = mysqli_fetch_array($retval,MYSQLI_ASSOC)){
			  
			   $sqlch = "SELECT * FROM channels where channel_name='".$getmembers['channel_name']."'";
			  $retval2 = mysqli_query($db,$sqlch);
			  $getchid = mysqli_fetch_array($retval2,MYSQLI_ASSOC);
			  
			  if(! $retval ) {
				  die('Could not get data: ');
			   }
			 // while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
				  
		  ?>
		  <li class="channel"><a class="channel_name"><span class="read"></span><span><span class="prefix">#</span><a style="color: white; text-decoration:none;" href=get-messages.php?id=<?php echo $getchid['channel_id']; ?> ><?php echo $getchid['channel_name']; ?></span></a></li>           
		   <?php 
		   }
		  ?>
          </ul>
		  	<!-- Invite members -->
		  
			<?php
				if(isset($_POST["Invite"])) {
					header("location: invite.php");
			   }
			?>
			<form action="" method="post">
			<div>
			<input name="Invite" class="button1" type="submit" value="Invite">
			</div>
			</form>
			<!-- accepting  notifications -->
			<br>
			<?php
				if(isset($_POST["Notif"])) {
					header("location: notification.php");
			   }
			?>
			<form action="" method="post">
			<div>
			<input name="Notif" class="button1" type="submit" value="Notifications">
			</div>
			</form>
        </div>
        <div class="listings_direct-messages">
          <h2 class="listings_header">Direct Messages</h2>
          <ul class="channel_list">
          </ul>
        </div>
      </div>
      <div class="message-history">
	  
		<?php
		
			if(isset($_GET['id'])) {
				$txt = $_GET['id'];
				$result = mysqli_query($db,"SELECT * FROM msg where channel_id=" . $txt . " ORDER BY STR_TO_DATE(`timestamp`,'%Y-%m-%d %H:%i:%s')");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					
					//get avatar of each user
					$avatarSql = mysqli_query($db,"SELECT avatar, username from users where username='".$row['username']."'");
			while($rowAvatar = mysqli_fetch_array($avatarSql, MYSQLI_ASSOC)) {
					//<img class="message_profile-pic" src="avatar/<?php echo $rowAvatar['avatar']; "/>
					//$testSql = mysqli_query($db,"SELECT * from voting_count where msg_id='".$row['msg_id']."'");
					//while($test = mysqli_fetch_array($testSql, MYSQLI_ASSOC)){
					
					$testSql = mysqli_query($db,"SELECT SUM(up_count) AS like_count from voting_count where msg_id='".$row['msg_id']."'");
					$likecount = mysqli_fetch_array($testSql, MYSQLI_ASSOC);
					
					$like_count = $likecount['like_count'];
					//$getCount = "SELECT up_count, down_count from voting_count";
					
					$testSql2 = mysqli_query($db,"SELECT SUM(down_count) AS dislike_count from voting_count where msg_id='".$row['msg_id']."'");
					$dislikecount = mysqli_fetch_array($testSql2, MYSQLI_ASSOC);
					
					$dislike_count = $dislikecount['dislike_count'];
					
		?>
			<div class="message"><form action = "" method = "post">
				<a class="message_profile-pic" href="">
					<img class="message_profile-pic" src="avatar/<?php echo $rowAvatar['avatar']; ?>"/>
				</a>
				
				<div class="hover-message" id=<?php echo $row['msg_id']; ?>>
				<a class="message_username" href=""><?php echo $row['username']; ?></a>
				<span class="message_timestamp"><?php echo date('M j Y g:i A', strtotime($row['timestamp'])); ?></span>
				
				
				<label class="voteUp"><?php echo $like_count; ?></label>
				<input type="submit" class="up_button" style="display: none; border: none; background: none; ">
					
					<input type="image" id=<?php echo $row['msg_id']; ?> src="images/thumbs-up.png" height="20" width="20" class="like" onclick="this.disabled=true;document.getElementsByClassName('dislike')[0].disabled=false;f1(this);window.location.reload();" value="1"/>
					
				</input>
				
				<label class="voteUp"><?php echo $dislike_count; ?></label>
				<input type="submit" class="down_button" style="display: none; border: none; background: none; ">
					<input type="image" id=<?php echo $row['msg_id']; ?> src="images/thumbs-down.png" height="20" width="20" class="dislike" onclick="this.disabled=true;document.getElementsByClassName('like')[0].disabled=false;f1(this);window.location.reload();" value="2"/>
				</input>
				
				</div>
			</form>
			
				<span class="message_star"></span><span class="message_content"><?php echo $row['message']; ?></span>
				<br>
					<input type="submit" class="btn btn-primary rep" style="display: none; border: none; background: none;">
					<input type="image" src="images/reply.png" height="20" width="20" id=<?php echo $row['msg_id']; ?> />
				</input>
				<!--<form class="comment_reply" data-id="" method="post" action="">-->
					<input type="hidden" class="hidden" value="" class="post_id">
				<!--	<textarea class="form-control" rows="3" name="post_rep" class="post_rep">
					</textarea>
					<button type="submit" class="btn btn-primary" class="post_rep_sub">Submit</button>-->
				<?php	echo "<input name=\"child-msg\" id=\"child-input-".$row['msg_id']."\" class=\"input-box_text\" type=\"text\"/>";?>
				<input type="submit" class="button1" value="reply" name="reply" id=<?php echo $row['msg_id']; ?> onclick="f2(this);window.location.reload();"/>
					
				<!-- //REPLY part-->	
				
				<div class="message">
				
					<?php
						$replySql = mysqli_query($db,"SELECT * FROM replies where msg_id= '".$row["msg_id"]."' ORDER BY STR_TO_DATE(`timestamp`,'%Y-%m-%d %H:%i:%s')");
						while($childrow = mysqli_fetch_array($replySql, MYSQLI_ASSOC)) {
								
							//get avatar of each user
							$avatarSql1 = mysqli_query($db,"SELECT avatar, username from users where username='".$childrow['username']."'");
							while($rowAvatar1 = mysqli_fetch_array($avatarSql1, MYSQLI_ASSOC)) {
									//<img class="message_profile-pic" src="avatar/<?php echo $rowAvatar['avatar']; "/>
							
							/// child message like and dislike counting 
							
							$testSql3 = mysqli_query($db,"SELECT SUM(up_count) AS c_like_count from child_voting_count where child_msg_id='".$childrow['reply_id']."'");
					$likecount = mysqli_fetch_array($testSql3, MYSQLI_ASSOC);
					
					$c_like_count = $likecount['c_like_count'];
					//$getCount = "SELECT up_count, down_count from voting_count";
					
					$testSql4 = mysqli_query($db,"SELECT SUM(down_count) AS c_dislike_count from child_voting_count where child_msg_id='".$childrow['reply_id']."'");
					$dislikecount = mysqli_fetch_array($testSql4, MYSQLI_ASSOC);
					
					$c_dislike_count = $dislikecount['c_dislike_count'];
									
									
								/*	$testSql = mysqli_query($db,"SELECT * from child_voting_count where child_msg_id='".$childrow['reply_id']."'");
									while($test1 = mysqli_fetch_array($testSql, MYSQLI_ASSOC)){ */
				
					?>
			<!--	<div class="message">-->
				<form action = "" method = "post">
					<a class="message_profile-pic" href="">
						<img class="message_profile-pic" src="avatar/<?php echo $rowAvatar1['avatar']; ?>"/>
					</a>
				
				<div class="hover-message1" id=<?php echo $childrow['reply_id']; ?>>
				<a class="message_username" href=""><?php echo $childrow['username']; ?></a>
				<span class="message_timestamp"><?php echo date('M j Y g:i A', strtotime($childrow['timestamp'])); ?></span>
			
			
				<label class="voteUp"><?php echo $c_like_count; ?></label>
				<input type="submit" class="up_button" style="display: none; border: none; background: none; ">
					
					<input type="image" id=<?php echo $childrow['reply_id']; ?> src="images/thumbs-up.png" height="20" width="20" class="like" onclick="this.disabled=true;document.getElementsByClassName('dislike')[0].disabled=false;f3(this);window.location.reload();" value="1"/>
					
				</input>
				
				<label class="voteUp"><?php echo $c_dislike_count; ?></label>
				<input type="submit" class="down_button" style="display: none; border: none; background: none; ">
					<input type="image" id=<?php echo $childrow['reply_id']; ?> src="images/thumbs-down.png" height="20" width="20" class="dislike" onclick="this.disabled=true;document.getElementsByClassName('like')[0].disabled=false;f3(this);window.location.reload();" value="2"/>
				</input>
				
				
			</form>
				<span class="message_star"></span><span class="message_content"><?php echo $childrow['child_msg']; ?></span>
				</div>
			<!--	</div> -->
						<?php 
								//}	
							}
							
						}
					?>
							
				</div>			
				<!--</form>-->		
							
				</div>
							
							
							
							
						
						<?php 
								}	
							}
							
						}
					?>
		
			<script type="text/javascript" >
						/*$('input:image').click(function() {
							alert($(this).val());
						});
						style="float: right;" 
						*/
						
						function f1(objButton){  
							var a = (objButton.value);
						//	var b = (objButton.id);
						
							 var msg_id = $(objButton).attr('id');
						//	alert (b);
							//var name = $("input:image").val();
							//alert (name);
							//return a;
							var d= {'vote':a, 'msg_id':msg_id}
							$.ajax({
								type: "GET",
								url: 'vote.php',
								 data:{'d1':d},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								   alert(data);
								}
							});
						}
						
						function f2(replyButton){  
						//	var a = (replyButton.value);
						//	v$ar b = (objButton.id);
						
							 var parent_id = $(replyButton).attr('id');
							 var input_val=$("#child-input-"+parent_id).val();
							 console.log(input_val);
						//	alert (b);
							//return a;
							var d= {'parent_id':parent_id, 'input_val':input_val}
							$.ajax({
								type: "POST",
								url: 'test1.php',
								 data:d,
								dataType: 'text',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  // alert(data);
								}
							});
						}
						
						function f3(replyVote){  
							var replyValue = (replyVote.value);
						//	var b = (objButton.id);
						
							 var child_msgid = $(replyVote).attr('id');
						//	alert (b);
							//var name = $("input:image").val();
							//alert (name);
							//return a;
							var childData= {'replyValue':replyValue, 'child_msgid':child_msgid}
							$.ajax({
								type: "GET",
								url: 'test2.php',
								 data:{'childData':childData},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								//   alert(data);
								}
							});
						}
						
		</script>
		
		<script type="text/javascript">
	/*	$(document).ready(function () {
			$(document).on('mouseenter', '.message', function () {
				$(this).find(":button").show();
			}).on('mouseleave', '.message', function () {
				$(this).find(":button").hide();
			});
		});
		*/
		///////////////////
		$(document).ready(function(){
		  $(document).on('click' , 'button.rep' , function(){
			 var closestDiv = $(this).closest('div'); // also you can use $(this).parent()
			 //closestDiv.fadeOut();
			 $('.comment_reply').not(closestDiv.next('.comment_reply')).hide();
			 //$('.rep').closest('div').not(closestDiv).show()
			 closestDiv.next('form.comment_reply').slideToggle(100);
		  });
		});
				
		</script>
		
		
       </div>
    </div>
    <div class="footer">
      <div class="user-menu">
		
		<?php
			$usernameSql = mysqli_query($db,"SELECT username, avatar from users where username='".$login_session."'");
			while($rowRes = mysqli_fetch_array($usernameSql, MYSQLI_ASSOC)) {
		?>
	  
		<span class="user-menu_profile-pic"><img class="user-menu_profile-pic" src="avatar/<?php echo $rowRes['avatar']; ?>"/></span>
		
		<div class="user-profile" >
			<ul>
			<li><a style="color: #ab9ba9; text-decoration:none;" href=profile.php?user=<?php echo $rowRes['username']; ?> >Profile</a></li>
			</ul>
		</div>
		
		<?php
			}
		?>
		
	  <span class="user-menu_username"><?php echo $login_session; ?></span> 
	  <span class="connection_status"><a style="color: #ab9ba9; text-decoration:none;" href="logout.php">Logout</a></span></div>
      
	  <div class="input-box">
		<form method="post" name="input" action=" " >
        <input name="message" class="input-box_text" type="text"/>
		
		<?php
		
		date_default_timezone_set('America/New_York');
		//echo date("l jS \of F Y h:i:s A") . "<br>";
		//$time =  time();
		$date = date('Y-m-d H:i:s');
	
		if(isset($_POST["message"])){
				
				//$sql = "INSERT INTO amusement_parks (username, timestamp, message)
				//VALUES ('".$login_session."','".$date."','".$_POST["message"]."')";
				$sql = "INSERT INTO msg (channel_id, username, timestamp, message)
				VALUES ('".$channel_id."','".$login_session."','".$date."','".addslashes(htmlspecialchars($_POST["message"]))."')";
		
			if ($db->query($sql) === TRUE) {
		//	echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $db->error."";
			}
			
		/*	$get_msgid = "SELECT msg_id from msg where timestamp='".$date."' AND message='".addslashes(htmlspecialchars($_POST["message"]))."'";
			$result1 = mysqli_query($db,$get_msgid);
			$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
				
			echo $row1["msg_id"];
			//}
			$vSql = "INSERT INTO voting_count (username, vote_up, msg_id,up_count, down_count)
				VALUES ('".$login_session."','0','".$row1["msg_id"]."','0','0')";
				if ($db->query($vSql) === TRUE){echo "New record created successfully";}
				else {
			echo "Error: " . $vSql . "<br>" . $db->error."";
			}
			*/
			header("Refresh: 0");
			exit;
		
		}
		
		

		?>
		
		</form>
      </div>
    </div>
  </body>
</html>
