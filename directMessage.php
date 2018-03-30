<?php
   include('session.php');
  ob_start();
  $channel_id= $_GET['id'];
  //$page= $_GET['page'];
  $msgSender= $_GET['sender'];
  $msgReceiver= $_GET['receiver'];
  
  
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchSubmit'])) {
		$searchUsername = $_POST['search_text']; 
		//$arr = explode(' ',trim($searchUsername));
		$arr = strtok($searchUsername, " "); 
		//echo $arr;
		$searchSql = "SELECT username from users where fname='$arr' ";  
		$searchResult = mysqli_query($db, $searchSql);  
        $searchedUser = mysqli_fetch_array($searchResult);
		$suser = $searchedUser["username"];
		header("location: profile.php?user=$suser");

	}
 
	if($msgSender == "Admin"){
		$url = "adminchatPage.php";
	}
	else{
		$url = "chatPage.php";
	}
?>

<!DOCTYPE html>
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
	<link rel="stylesheet" href="css/page.css">
	<link rel="stylesheet" href="css/overlay.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/search-bar.css">
	<link rel="stylesheet" href="css/dropdown1.css">
	<link rel="stylesheet" href="css/blockquote.css">
  </head>
  <body>
  
    <div class="header">
      <div class="team-menu">Tourism</div>
      <div class="channel-menu"><span class="channel-menu_name"><span class="channel-menu_prefix">#</span><?php echo $msgReceiver; ?></span>			
	  </div>
	</div>
    <div class="main">
      <div class="listings">
	  <!-- Navigation Bar -->
	  <?php
		if($msgSender == 'Admin'){
	  ?>
		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="invite.php">Invite</a>
		  <?php
		  $ncountSql = mysqli_query($db,"SELECT COUNT(invite_id) AS notification_count from invitation where receiver_name='".$login_session."'");
		$usern_count1 = mysqli_fetch_array($ncountSql, MYSQLI_ASSOC);
		
		$notification_count = $usern_count1['notification_count'];
		  
		  if ($notification_count !=0){
		  ?>
		  <a href="notification.php">Notifications -  <code><?php echo $notification_count ?><code></a> 
		  <?php
		  }
		  else{
			  ?>
			  <a href="notification.php">Notifications</a> 
		  <?php
		  }
		  ?>
		  
		  <a href="updateProfile.php">Update Profile</a>
		  <a href="archive.php" id="arc">Archive</a>
		  <a href="unarchive.php" id="unarc">Unarchive</a>
		  <a href="editMembership.php" id="member">Edit Membership</a>
		  <a href="dashboard.php" id="member">Dashboard</a>
          <a href="help.php" id="member">Help</a>
			
			<br></br>
			<form id="searchForm" method="post" autocomplete="off">
			  <input type="text" class="search" name="search_text" id="search_text" placeholder="Search..">
			  <input type="submit" class = "button1" name="searchSubmit" value="Search">
				<br />
				<div id="result"></div>
			</form>
		</div>
		<span style="font-size:25px;cursor:pointer; margin-left:12px;" onclick="openNav()">&#9776; Menu</span>
		
		<?php
		}
		else{
	  ?>
		<div id="mySidenav" class="sidenav">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		  <a href="invite.php">Invite</a>
		  <?php
		  $ncountSql = mysqli_query($db,"SELECT COUNT(invite_id) AS notification_count from invitation where receiver_name='".$login_session."'");
		$usern_count1 = mysqli_fetch_array($ncountSql, MYSQLI_ASSOC);
		
		$notification_count = $usern_count1['notification_count'];
		  
		  if ($notification_count !=0){
		  ?>
		  <a href="notification.php">Notifications -  <code><?php echo $notification_count ?><code></a> 
		  <?php
		  }
		  else{
			  ?>
			  <a href="notification.php">Notifications</a> 
		  <?php
		  }
		  ?>
		  
		  <a href="updateProfile.php">Update Profile</a>
          <a href="help.php" id="member">Help</a>
			
			<br></br>
			<form id="searchForm" method="post" autocomplete="off">
			  <input type="text" class="search" name="search_text" id="search_text" placeholder="Search..">
			  <input type="submit" class = "button1" name="searchSubmit" value="Search">
				<br />
				<div id="result"></div>
			</form>
		</div>
		<span style="font-size:25px;cursor:pointer; margin-left:12px;" onclick="openNav()">&#9776; Menu</span>
		
		<?php
		}
		?>
		<script>
		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
		}
		</script>
		
		<script>
			
			$(document).ready(function(){  
      $('#search_text').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"searchData.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#result').fadeIn();  
                          $('#result').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
          $('#search_text').val($(this).text());  
           $('#result').fadeOut();  
		 //   var formAction = $('#search_text').attr('action');
		//	$('#search_text').attr('action', formAction + id);
      });  
 });  
 $( '#searchForm' ).each(function(){
    this.reset();
});
		</script>
		
	   <!-- End Navigation Bar -->
        
		<div class="listings_channels">
          <h2 class="listings_header">Channels <span>
		  
		  <a style="color: white; text-decoration:none; margin-left: 6.0em;" href=addChannels.php >
		  
		  <img src="images/plus_add_green.png" alt="+" width="18" height="18" border="0">
		  </a></span></h2>
          <ul class="channel_list">
            <?php
			
				//to retrieve channel names
			  $sql = "SELECT * FROM membership where username='".$login_session."'";
			  $retval = mysqli_query($db,$sql);
			  while($getmembers = mysqli_fetch_array($retval,MYSQLI_ASSOC)){
			  
			   $sqlch = "SELECT * FROM channels where channel_name='".addslashes(htmlspecialchars($getmembers['channel_name']))."'";
			  $retval2 = mysqli_query($db,$sqlch);
			  $getchid = mysqli_fetch_array($retval2,MYSQLI_ASSOC);
			  
			  if(! $retval ) {
				  die('Could not get data: ');
			   }
			 // while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
				  
		  ?>
		  <li class="channel"><a class="channel_name"><span class="read"></span><span><span class="prefix">#</span><a style="color: white; text-decoration:none;" href=<?php echo $url ?>?id=<?php echo $getchid['channel_id']; ?>&page=1 ><?php echo $getchid['channel_name']; ?></span></a></li>           
		   <?php 
		   }
		  ?>
          </ul>
			
        </div>
        <div class="listings_direct-messages">
          <h2 class="listings_header">Direct Messages</h2>
          <ul class="channel_list">
		  <?php
			$sqldm = "SELECT username FROM users where username !='".$login_session."' ";
			  $retUsers = mysqli_query($db,$sqldm);
			  while($getUsers = mysqli_fetch_array($retUsers,MYSQLI_ASSOC))
			  {
			?>
			<li class="channel"><a class="channel_name"><span><span class="prefix"> </span><a style="color: white; text-decoration:none;" href=directMessage.php?id=<?php echo $getchid['channel_id']; ?>&sender=<?php echo $login_session; ?>&receiver=<?php echo $getUsers['username']; ?> ><?php echo $getUsers['username']; ?></span></a></li>
          <?php 
		   }
		  ?>
		  </ul>
        </div>
      </div>
	
      <div class="message-history" id="formid">
		
		<?php
		
		$result = mysqli_query($db,"SELECT * FROM direct_message where (sender= '".$msgSender."' AND receiver='".$msgReceiver."') OR (sender= '".$msgReceiver."' AND receiver='".$msgSender."') ORDER BY STR_TO_DATE (`timestamp`,'%Y-%m-%d %H:%i:%s') ");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
			//get avatar of each user
			$avatarSql = mysqli_query($db,"SELECT avatar, username, gravatar, profile_flag from users where username='".$row['sender']."'");
			while($rowAvatar = mysqli_fetch_array($avatarSql, MYSQLI_ASSOC)) {
			?>
			<div class="message"><form action = "" method = "post">
				<a class="message_profile-pic" href="">
					<?php 
		
						$header_response = get_headers($rowAvatar['gravatar'], 1);
						if($header_response[0]!== "HTTP/1.1 404 Not Found" && $rowAvatar['profile_flag'] == 1)
							{		
						?>
						<img class="message_profile-pic" src="<?php echo $rowAvatar['gravatar']; ?>"/>
						
						<?php
								
						}
							else
							{
								
								if (filter_var($rowAvatar['avatar'], FILTER_VALIDATE_URL)) 
								{ 
									

									$header_response = get_headers($rowAvatar['avatar'], 1);
									if ( strpos( $header_response[0], "404" ) !== true )
									{				
								?>
								
									<img class="message_profile-pic" src="<?php echo $rowAvatar['avatar']; ?>"/>
						
							<?php
									}
								}else{

						?>
						  <img class="message_profile-pic" src="avatar/<?php echo $rowAvatar['avatar']; ?>"/>
						  
						 <?php
								}
							}
					?>
				</a>
				
				<div class="hover-message" id=<?php echo $row['dm_id']; ?> >
				<a class="message_username" href=""><?php echo $row['sender']; ?></a>
				<span class="message_timestamp"><?php echo date('M j Y g:i A', strtotime($row['timestamp'])); ?></span>
			</form>
			
			<?php
				//Check Local files
				if(file_exists("msg_images/".$row['dm_message'])){
					if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $row['dm_message']) || preg_match('(.jpg|.png|.bmp|.gif)', $row['dm_message'])=== 1)
					{					
			?>
				<span class="message_star"></span><span class="message_content"><img src="msg_images/<?php echo $row['dm_message']; ?>" height="250" width="300"/></span>
			
			<?php
					}
					else{
					?>
					<span class="message_star"></span><span class="message_content"><a href="msg_images/<?php echo $row['dm_message']; ?>" download=<?php echo $row['dm_message']; ?> ><?php echo $row['dm_message'];?></a></span>
					<?php	
					}	
				}
				
				//To check web URL
				else if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $row['dm_message']) || preg_match('(.jpg|.png|.bmp|.gif)', $row['dm_message'])=== 1)
				{					
				?>				
					<span class="message_star"></span><span class="message_content"><?php echo $row['dm_message']; ?></span>
				
				<?php
				
				if (filter_var($row['dm_message'], FILTER_VALIDATE_URL)) 
				{ 

				$header_response = get_headers($row['dm_message'], 1);
					if ( strpos( $header_response[0], "404" ) !== true )
					{				
				?>
				
					<span class="message_star"></span><span class="message_content"><img src=<?php echo $row['dm_message']; ?> height="250" width="300"/></span>
			
			<?php
					}
				}
				}
				
				
			else if(substr( $row['dm_message'], 0, 5 ) === "/code"){
			?>
				<span class="message_star"></span><blockquote><p><?php echo nl2br(substr(strstr($row['dm_message']," "), 1)); ?></p></blockquote>
			<?php	
				}	
				else if(substr( $row['dm_message'], 0, 3 ) === "/me"){
					$meline = substr(strstr($row['dm_message']," "), 1);
			?>
					<br><span class="message_star"></span><span><font face="Comic Sans MS" color="red"><b><?php echo $meline; ?></b></font></span>
			<?php	
				}
				else if(substr( $row['dm_message'], 0, 6 ) === "/shrug"){
			?>
					<span class="message_star"></span><span class="message_content"><?php echo nl2br(substr(strstr($row['dm_message']," "), 1)); ?>&nbsp;&nbsp;<font face="Comic Sans MS" color="#5B2C6F"><b>¯\_(ツ)_/¯</b></font> </span>
			<?php	
				}
			else{
			?>
				<span class="message_star"></span><span class="message_content"><?php echo nl2br($row['dm_message']); ?></span>
			<?php
			}
			?>						
				</div>
							
			</div>	
				<?php 
								}	
							}
		?>
							
					<script>
								$(document).ready(function() {
									$(".creepy").click (function(e) 
								{
								e.preventDefault();
								$(this).parents().next('.comment_form').toggle();
								});
								});
				  </script>	
					
					
					<script type="text/javascript" >
						
						function toggleBox(msgBox){  
							//jQuery(document).ready(function(){
								var parent_id = $(msgBox).attr('id');
								jQuery(parent_id).on('click', function(event) {        
									 jQuery(parent_id).toggle('show');
								});
						}
						
						function f1(objButton){  
							var a = (objButton.value);
						
							 var msg_id = $(objButton).attr('id');
						
							var d= {'vote':a, 'msg_id':msg_id}
							$.ajax({
								type: "GET",
								url: 'vote.php',
								 data:{'d1':d},
								dataType: 'json',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								//   alert(data);
								}
							});
						}
						
						function f2(replyButton){  
					
							 var parent_id = $(replyButton).attr('id');
							 var input_val=$("#child-input-"+parent_id).val();
							 console.log(input_val);
					
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
						
							 var child_msgid = $(replyVote).attr('id');
							//var name = $("input:image").val();
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
						
						function deletePost(deleteButton){  
					
							 var parent_id = $(deleteButton).attr('id');
							 //var input_val=$("#child-input-"+parent_id).val();
							// console.log(input_val);
					
							//return a;
							var d= {'parent_id':parent_id}
							$.ajax({
								type: "POST",
								url: 'deletePost.php',
								 data:d,
								dataType: 'text',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  // alert(data);
								}
							});
						}
						
						
						function deleteChildPost(deleteChildButton){  
					
							 var child_id = $(deleteChildButton).attr('id');
							 //var input_val=$("#child-input-"+parent_id).val();
							// console.log(input_val);
					
							//return a;
							var d= {'child_id':child_id}
							$.ajax({
								type: "POST",
								url: 'deletePost.php',
								 data:d,
								dataType: 'text',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  // alert(data);
								}
							});
						}
		</script>
		
		<script type="text/javascript">
	
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
			$usernameSql = mysqli_query($db,"SELECT username, avatar, gravatar, profile_flag from users where username='".$msgSender."'");
			while($rowRes = mysqli_fetch_array($usernameSql, MYSQLI_ASSOC)) {
				$header_response = get_headers($rowRes['gravatar'], 1);
				if($header_response[0]!== "HTTP/1.1 404 Not Found" && $rowRes['profile_flag'] == 1)
					{		
				?>
				<span class="user-menu_profile-pic"><img class="user-menu_profile-pic" src="<?php echo $rowRes['gravatar']; ?>"/></span>
		
				<?php
						
				}
					else
					{
						if (filter_var($rowRes['avatar'], FILTER_VALIDATE_URL)) 
									{	 
									

									$header_response = get_headers($rowRes['avatar'], 1);
									if ( strpos( $header_response[0], "404" ) !== true )
										{	
											
								?>
								
									<span class="user-menu_profile-pic"><img class="user-menu_profile-pic" src="<?php echo $rowRes['avatar']; ?>"/></span>
		
							<?php
										}
									}	else{
				?>
				  <span class="user-menu_profile-pic"><img class="user-menu_profile-pic" src="avatar/<?php echo $rowRes['avatar']; ?>"/></span>
		
				 <?php
						}
					}
				?>
		
		<div class="user-profile" >
			<ul>
			<li><a style="color: #ab9ba9; text-decoration:none;" href=profile.php?user=<?php echo $rowRes['username']; ?> >Profile</a></li>
			</ul>
		</div>
		
		<?php
			}
		?>
		
		<span class="user-menu_username"><?php echo $login_session; ?></span>
		<span class="connection_status"><a style="color: #ab9ba9; text-decoration:none;" href="logout.php">Logout</a></span>
	  </div>
	  
	  <div class="input-box">
		
		<div class='menu--main' style="left:15%;position:absolute;display:inline-block;" id="formid3">
				<input type="submit" name="localImage" id=<?php echo $channel_id; ?> style="display: none; border: none; background: none;" >
				 <input type="image" src="images/attach.png" height="35" width="35" id=<?php echo $channel_id; ?> onclick="addLocalImg(this);window.location.reload();"/>
				</input>
				
				<script>
					function addLocalImg(addImg){  
							var rec = "<?php echo $msgReceiver ?>";
							 //var input_val=$("#child-input-"+parent_id).val();
							// console.log(input_val);
					
							//return a;
							var d= {'rec':rec}
							$.ajax({
								type: "POST",
								url: 'directLocalFiles.php',
								 data:rec,
								dataType: 'text',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  // alert(data);
								   window.location = 'directLocalFiles.php?rec='+rec;
								}
							});
						}
				</script>
				 
		</div>
		<form method="post" name="input" action=" " id="formid1">
		
      <!--   <input name="message" class="input-box_text1" type="text"/>  -->

		<textarea name="message" class="input-box_text1"></textarea>
		
		
		<input type="submit" class="button2" value="Post" name="post" onclick="window.location.reload();" style="position:absolute"/>
			
		<?php
		
		date_default_timezone_set('America/New_York');
		//access channel_id
		//echo date("l jS \of F Y h:i:s A") . "<br>";
		//$time =  time();
		//&& strlen($_POST["message"] != 0)
		$date = date('Y-m-d H:i:s');
		
		if(isset($_POST["message"]) ){
			
				$sql = "INSERT INTO direct_message (sender, receiver, timestamp, dm_message)
				VALUES ('".$msgSender."','".$msgReceiver."','".$date."','".addslashes(htmlspecialchars($_POST["message"]))."')";
				
				
		
			if ($db->query($sql) === TRUE) {
			//echo "New record created successfully";
			} else {
			//echo "Error: " . $sql . "<br>" . $db->error."";
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
