<?php
   include('session.php');
  ob_start();
  $channel_id= $_GET['id'];
  $page= $_GET['page'];
  
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
	  <?php
		$sql1 = 'SELECT channel_name FROM channels where channel_id =' .$channel_id;
		  $retval1 = mysqli_query($db,$sql1);
		  
		  if(! $retval1 ) {
			  die('Could not get data: ');
		   }
		   $channelNm = mysqli_fetch_assoc($retval1);
		   
		   
		   
		   
			$arcSql = "SELECT * FROM archive WHERE channel_id = '".$channel_id."'";
		  $arcresult = mysqli_query($db,$arcSql);
		  $arcrow = mysqli_fetch_array($arcresult,MYSQLI_ASSOC);
		  $arccount = mysqli_num_rows($arcresult);
		  if($arccount == 1) {
		  ?>
		  <script type="text/javascript">
		  
				$(document).ready(function(){
					$("#formid :input").prop("disabled", true);
					$("#formid1 :input").prop("disabled", true);
					$("#formid2 :input").prop("disabled", true);
					$("#formid3 :input").prop("disabled", true);
					$("#formid7 :input").prop("disabled", false);
					$(".creepy").prop("disabled", false);
				});
			</script>
			
			<?php
		  }
		  
		  if($arccount == 1)
		  {
			?>
		   
		   
	  
      <div class="channel-menu"><span class="channel-menu_name"><span class="channel-menu_prefix">#</span><?php echo $channelNm['channel_name']; ?>&nbsp&nbsp&nbsp<img src="images/archive.jpg " height="27" width="35"/><font color=red > &nbsp&nbsp&nbsp  Channel is Archived (posting is disabled)</font></span>
			<?php	
		  }
		  else{
			  ?>
		      <div class="channel-menu"><span class="channel-menu_name"><span class="channel-menu_prefix">#</span><?php echo $channelNm['channel_name']; ?>&nbsp&nbsp&nbsp<img src="images/unarchive.jpg " height="27" width="50"/></span>
  <?php
		  }
		  ?>
			
			
	  </div>
	</div>
    <div class="main">
      <div class="listings">
	  <!-- Navigation Bar -->
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
		   <?php
			$unarcSql = "SELECT * FROM archive WHERE channel_id = '".$channel_id."'";
		  $unarcresult = mysqli_query($db,$unarcSql);
		  $unarcrow = mysqli_fetch_array($unarcresult,MYSQLI_ASSOC);
		  $unarccount = mysqli_num_rows($unarcresult);
		  if($unarccount == 1) {
		  ?>
			<script type="text/javascript">
			
				$(document).ready(function(){
					$("#formid :input").prop("enabled", true);
					$("#formid1 :input").prop("enabled", true);
					$("#formid2 :input").prop("enabled", true);
					$("#formid3 :input").prop("enabled", true);
				});
				/*document.getElementById("unarc").onclick = enableScreen;

					function enableScreen() {
						// creates <div class="overlay"></div> and 
						// adds it to the DOM
						//var div= document.createElement("div");
						//div.className += "overlay";
						//document.body.appendChild(div);
						$( ".overlay" ).remove();
					}*/
			</script>
			<?php
		  }
			?>
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
		  <li class="channel"><a class="channel_name"><span class="read"></span><span><span class="prefix">#</span><a style="color: white; text-decoration:none;" href=adminchatPage.php?id=<?php echo $getchid['channel_id']; ?>&page=1 ><?php echo $getchid['channel_name']; ?></span></a></li>           
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
		<!-- Pagination -->
		<?php
		//	$limit = 2;  
		
	
		// define how many results you want per page
		 $results_per_page = 5;
		 
		 // find out the number of results stored in database
		$sql1="SELECT * FROM msg where channel_id='".$channel_id."'";
		$result1 = mysqli_query($db, $sql1);
		$number_of_results = mysqli_num_rows($result1);
		
		// determine number of total pages available
		$number_of_pages = ceil($number_of_results/$results_per_page);
		
		// determine which page number visitor is currently on
		if (!isset($_GET['page'])) {
		  $page = 1;
		} else {
		  $page = $_GET['page'];
		}
		
		// determine the sql LIMIT starting number for the results on the displaying page
		$this_page_first_result = ($page-1)*$results_per_page;
		if($page >=1 && $page <= $number_of_pages)
	{
		$result = mysqli_query($db,"SELECT * FROM msg where channel_id= $channel_id ORDER BY STR_TO_DATE (`timestamp`,'%Y-%m-%d %H:%i:%s')LIMIT $this_page_first_result, $results_per_page ");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				
			//get avatar of each user
			$avatarSql = mysqli_query($db,"SELECT avatar, username,gravatar,profile_flag from users where username='".$row['username']."'");
			while($rowAvatar = mysqli_fetch_array($avatarSql, MYSQLI_ASSOC)) {
					
					
					$testSql = mysqli_query($db,"SELECT SUM(up_count) AS like_count from voting_count where msg_id='".$row['msg_id']."'");
					$likecount = mysqli_fetch_array($testSql, MYSQLI_ASSOC);
					
					$like_count = $likecount['like_count'];
					
					$testSql2 = mysqli_query($db,"SELECT SUM(down_count) AS dislike_count from voting_count where msg_id='".$row['msg_id']."'");
					$dislikecount = mysqli_fetch_array($testSql2, MYSQLI_ASSOC);
					
					$dislike_count = $dislikecount['dislike_count'];
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
				
				<div class="hover-message" id=<?php echo $row['msg_id']; ?> >
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
				
				<input type="submit" name="delete" style="display: none; border: none; background: none;" id=<?php echo $row['msg_id']; ?> >
					<input type="image" src="images/delete.png" height="25" width="25" id=<?php echo $row['msg_id']; ?> onclick="deletePost(this);window.location.reload();"/>
				</input>
				</div>
			</form>
			
			<?php
				//Check Local files
				if(file_exists("msg_images/".$row['message'])){
					if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $row['message']) || preg_match('(.jpg|.png|.bmp|.gif)', $row['message'])=== 1)
					{					
			?>
				<span class="message_star"></span><span class="message_content"><img src="msg_images/<?php echo $row['message']; ?>" height="250" width="300"/></span>
			
			<?php
					}
					else{
					?>
					<span class="message_star"></span><span class="message_content"><a href="msg_images/<?php echo $row['message']; ?>" download=<?php echo $row['message']; ?> ><?php echo $row['message'];?></a></span>
					<?php	
					}	
				}
				
				//To check web URL
				else if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $row['message']) || preg_match('(.jpg|.png|.bmp|.gif)', $row['message'])=== 1)
				{					
				?>				
					<span class="message_star"></span><span class="message_content"><?php echo $row['message']; ?></span>
				
				<?php
				
				if (filter_var($row['message'], FILTER_VALIDATE_URL)) 
				{ 

				$header_response = get_headers($row['message'], 1);
					if ( strpos( $header_response[0], "404" ) !== true )
					{				
				?>
				
					<span class="message_star"></span><span class="message_content"><img src=<?php echo $row['message']; ?> height="250" width="300"/></span>
			
			<?php
					}
				}
				}
				
				//Check Code 
				else if(substr( $row['message'], 0, 5 ) === "/code"){
			?>
					<span class="message_star"></span><blockquote><p><?php echo nl2br(substr(strstr($row['message']," "), 1)); ?></p></blockquote>
			<?php	
				}
				else if(substr( $row['message'], 0, 3 ) === "/me"){
					$meline = substr(strstr($row['message']," "), 1);
			?>
					<span class="message_star"></span><span><font face="Comic Sans MS" color="red"><b><?php echo $meline; ?></b></font></span>
			<?php	
				}
				else if(substr( $row['message'], 0, 6 ) === "/shrug"){
			?>
					<span class="message_star"></span><span class="message_content"><?php echo nl2br(substr(strstr($row['message']," "), 1)); ?>&nbsp;&nbsp;<font face="Comic Sans MS" color="#5B2C6F"><b>¯\_(ツ)_/¯</b></font> </span>
			<?php	
				}
				else if(substr( $row['message'], 0, 4 ) === "/who"){
					if($login_session === $row['username']){
			?>
					<span class="message_star"></span><span class="message_content">Users: <?php echo nl2br(substr(strstr($row['message']," "), 1)); ?>&nbsp;&nbsp;(Only visible to you.)</span>
			<?php	
					}
				else{
			?>
						<span class="message_star"></span><span class="message_content">Secured message for user.</span>
			<?php
					}
				}
			else{
			?>
				<span class="message_star"></span><span class="message_content"><?php echo nl2br($row['message']); ?></span>
			<?php
			}
			?>			
				
				<br>
				
				<div>
				<input type="submit" class="btn btn-primary rep" style="display: none; border: none; background: none;">
					<input type="image" class ="creepy" src="images/reply.png" height="20" width="20" id=<?php echo $row['msg_id']; ?>  onclick="toggleBox(this);" />
				<?php
				$replycountSql = mysqli_query($db,"SELECT COUNT(child_msg) AS userreply_count from replies where msg_id='".$row['msg_id']."'");
				$userreply_count1 = mysqli_fetch_array($replycountSql, MYSQLI_ASSOC);
		
				$userreply_count = $userreply_count1['userreply_count'];
				if($userreply_count != 0)
				{
				?>
				
				</input>
				<input type="submit" class ="creepy" id ="formid8" name="no of replies" value ="<?php echo $userreply_count; ?> <?php if($userreply_count ==1){?>Reply <?php  } else{?>Replies <?php } ?>" height="20" width="20" id=<?php echo $row['msg_id']; ?>  onclick="toggleBox(this);" />
				
				<?php
				}
				?>
				
				
				</div>
				<div class="comment_form"  style="display: none;">
					<form class="comment_reply1"  method="post" action="">
				
				<!--<form class="comment_reply" data-id="" method="post" action="">
					<input type="hidden" class="hidden" value="" class="post_id">-->
				<div class='menu--main' style="margin-left: 0.5cm;" id="formid2">
				<!--<ul class='menu--main'>
					<li>
						<input type="image" src="images/plus.png" height="20" width="20" />
						<ul class='sub-menu'>
						  <li><a href="localImage.php" style="color: black; text-decoration:none;">Local Image</a></li>
						</ul>
					  </li>
					 </ul>-->
					<!-- <form method="post" name="input" action="localImage.php"> </form> -->
						<input type="submit" name="localImage" id=<?php echo $row['msg_id']; ?> style="display: none; border: none; background: none; " >
						 <input type="image" src="images/attach.png" height="35" width="35" id=<?php echo $row['msg_id']; ?> onclick="replyLocalImg(this);window.location.reload();" />
						</input>
						
						<script>
							function replyLocalImg(replyImg){  
							
									 var msg_id = $(replyImg).attr('id');
									 //var input_val=$("#child-input-"+parent_id).val();
									// console.log(input_val);
							
									//return a;
									var d= {'msg_id':msg_id}
									$.ajax({
										type: "POST",
										url: 'replyLocalImage.php',
										 data:msg_id,
										dataType: 'text',
										success: function(data)
										{
										   // $(".voteUp").html(data);
										  // alert(data);
										   window.location = 'replyLocalImage.php?msg_id='+msg_id;
										}
									});
								}
						</script>
					
			</div>
				<div id="content" style="margin-left: 0.7cm;">
				<?php	//echo "<input name=\"child-msg\" id=\"child-input-".$row['msg_id']."\" class=\"input-box_text\" type=\"text\"/>";?>
				
				<?php	echo "<textarea name=\"child-msg\" id=\"child-input-".$row['msg_id']."\" class=\"input-box_text\" ></textarea>";?>
				
				<input type="submit" class="button1" value="reply" name="reply" id=<?php echo $row['msg_id']; ?> onclick="f2(this);window.location.reload();"/>
				
				
				
				</div>
			
				
				<!-- //REPLY part-->	
				
				<div class="message">
				
					<?php
						$replySql = mysqli_query($db,"SELECT * FROM replies where msg_id= '".$row["msg_id"]."' ORDER BY STR_TO_DATE(`timestamp`,'%Y-%m-%d %H:%i:%s')");
						while($childrow = mysqli_fetch_array($replySql, MYSQLI_ASSOC)) {
								
						//get avatar of each user
						$avatarSql1 = mysqli_query($db,"SELECT avatar, username, gravatar, profile_flag from users where username='".$childrow['username']."'");
						while($rowAvatar1 = mysqli_fetch_array($avatarSql1, MYSQLI_ASSOC)) {
								
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
					
						<?php 
		
							$header_response = get_headers($rowAvatar1['gravatar'], 1);
							if($header_response[0]!== "HTTP/1.1 404 Not Found" && $rowAvatar1['profile_flag'] == 1)
								{		
							?>
							<img class="message_profile-pic" src="<?php echo $rowAvatar1['gravatar']; ?>"/>
							
							<?php
									
							}
								else
								{
									if (filter_var($rowAvatar1['avatar'], FILTER_VALIDATE_URL)) 
									{	 
									

									$header_response = get_headers($rowAvatar1['avatar'], 1);
									if ( strpos( $header_response[0], "404" ) !== true )
										{	
											
								?>
								
									<img class="message_profile-pic" src="<?php echo $rowAvatar1['avatar']; ?>"/>
						
							<?php
										}
									}	else{
							?>
							  <img class="message_profile-pic" src="avatar/<?php echo $rowAvatar1['avatar']; ?>"/>
							  
							 <?php
									}
								}
						?>
							
					</a>
				
				<div class="hover-message1" id=<?php echo $childrow['reply_id']; ?> >
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
				
				<input type="submit" name="delete" style="display: none; border: none; background: none; " id=<?php echo $childrow['reply_id']; ?> >
					<input type="image" src="images/delete.png" height="25" width="25" id=<?php echo $childrow['reply_id']; ?> onclick="deleteChildPost(this);window.location.reload();"/>
				</input>
				
			</form>
				<?php
				//Check Local files
				if(file_exists("msg_images/".$childrow['child_msg'])){
					if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $childrow['child_msg']) || preg_match('(.jpg|.png|.bmp|.gif)', $childrow['child_msg'])=== 1)
					{					
			?>
				<span class="message_star"></span><span class="message_content"><img src="msg_images/<?php echo $childrow['child_msg']; ?>" height="250" width="300"/></span>
			
			<?php
					}
					else{
					?>
					<span class="message_star"></span><span class="message_content"><a href="msg_images/<?php echo $childrow['child_msg']; ?>" download=<?php echo $childrow['child_msg']; ?> ><?php echo $childrow['child_msg'];?></a></span>
					<?php	
					}	
				}
				
				//To check web URL
				else if (preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $childrow['child_msg']) || preg_match('(.jpg|.png|.bmp|.gif)', $childrow['child_msg'])=== 1)
				{					
				?>				
					<span class="message_star"></span><span class="message_content"><?php echo $childrow['child_msg']; ?></span>
				
				<?php
				
				if (filter_var($childrow['child_msg'], FILTER_VALIDATE_URL)) 
				{ 

				$header_response = get_headers($childrow['child_msg'], 1);
					if ( strpos( $header_response[0], "404" ) !== true )
					{				
				?>
				
					<span class="message_star"></span><span class="message_content"><img src=<?php echo $childrow['child_msg']; ?> height="250" width="300"/></span>
			
			<?php
					}
				}
				}
				
				//Check Code 
				else if(substr( $childrow['child_msg'], 0, 5 ) === "/code"){
			?>
					<span class="message_star"></span><blockquote><p><?php echo nl2br(substr(strstr($childrow['child_msg']," "), 1)); ?></p></blockquote>
			<?php	
				}
				else if(substr( $childrow['child_msg'], 0, 3 ) === "/me"){
			?>
					<br><span class="message_star"></span><span><font face="Comic Sans MS" color="red"><b><?php echo nl2br(substr(strstr($childrow['child_msg']," "), 1)); ?></b></font></span>
			<?php	
				}
				else if(substr( $childrow['child_msg'], 0, 6 ) === "/shrug"){
			?>
					<span class="message_star"></span><span class="message_content"><?php echo nl2br(substr(strstr($childrow['child_msg']," "), 1)); ?>&nbsp;&nbsp;<font face="Comic Sans MS" color="#5B2C6F"><b>¯\_(ツ)_/¯</b></font> </span>
			<?php	
				}
			else{
			?>
				<span class="message_star"></span><span class="message_content"><?php echo nl2br($childrow['child_msg']); ?></span>
			<?php
			}
			?>	
				
				</div>
			<!--	</div> -->
						<?php 
								//}	
							}
							
						}
					?>
							
				</div>			
				</form>	
							
				
				</div>
							
						</div>	
							
							
						
						<?php 
								}	
							}
							}
		else {
		?>
		<br></br>
		<div> <p><font size="7"> No posts exist in this page ! </font> </p> </div>
		
		
		<?php
		
		}	
	      		?>
		<br></br><br></br>
		
		<?php
		
		
				echo '<div class="pagination">';
						echo '<ul class="nav">';
		?>
		 <form method="post" name="input" action=" " id="formid7">
		<?php
						if($page != 1)
						{	
							echo '<a  id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.($page-1) .'"> <font size="4">&nbsp&nbsp &laquo; </font></a>';	
						}
		
		
						?>
	 
	 
	 
	 
	 <a><font size="3"> &nbsp&nbsp Page &nbsp <?php echo $page?> of &nbsp <?php echo $number_of_pages?>&nbsp </font> </a>
	 
	 
		<?php				
					if($page != $number_of_pages)
					{
					echo '<a id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.($page+1) .'"><font size="4">&raquo;&nbsp &nbsp</font></a>';	
					}
		
			
		?>
					
					<!--- TEXT BOX FR PAGE N0 -->
					
					<a><font size="3">&nbsp &nbspGo to page:&nbsp <input type="text" method ="post" name="pgno" size="1" ></input>
					<input type="submit" class="button2" value="GO" name="GO" onclick="window.location.reload();" ></input></font></a>
					
					
		<?php
		
		
		if(isset($_POST["pgno"]) ){
			
				$page1 = $_POST["pgno"];
				$page = ceil( $_POST["pgno"]);
				if($page >=1 && $page <=$number_of_pages)
				{
				 echo '<a style="display:none" id="ac" href="adminchatPage.php?id='.$channel_id.'&page='.$page .'">' . $page . '</a> ';
		 ?>
				 <script>
				 document.getElementById('ac').click();
				 </script>
			<?php
				}
				else 
				{
					
				?>
					</div>
					<br> </br> 
					<div > <span><font size="4"> Page <?php echo $page1 ?> doesnot exist. Enter valid page number! </font> </span></div>
					
				<?php
				}
					
			
				}
				?>
					
					</form>
	      
	      
							
				<?php	/*	echo '<div class="pagination">';
						echo '<ul class="nav">';
						echo '<a id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.(1) .'">First</a>';
						if($page != 1)
						{	
							echo '<a id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.($page-1) .'">&laquo;</a>';	
						}
							// display the links to the pages
						//$first=1;
						//$last = $first + 2;
						//do{
					for ($i=1;$i<=$number_of_pages;$i++) {
						
						//for($j=$first;$j<=$last;$j++){
					 // echo '<li><a href="adminchatPage.php?page=' . $page . '">' . $page . '</a> </li>';
					   echo '<a id="page'.$i.'" href="adminchatPage.php?id='.$channel_id.'&page='.$i .'">' . $i . '</a> ';
						//}
					//	$first=$last;
					//	$last = $first + 2;
					}
						//}while($page ==$last);
						
					if($page != $number_of_pages)
					{
					echo '<a id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.($page+1) .'">&raquo;</a>';	
					}
					echo '<a id="page1'.$page.'" href="adminchatPage.php?id='.$channel_id.'&page='.($number_of_pages) .'">Last</a>';
					echo '</ul>';
					 echo '</div>';
							
						//}*/ ?>
					
					
					<script>
					//for pagination
					/*var selector = '.nav li a';
						$(selector).on('click', function(){
						$(selector).removeClass('active');
						$(this).addClass('active');
					});*/
					
					/*var pageId="page"+location.search.substring(location.search.indexOf('page=')+5,location.search.length);
                console.log(pageId);
                $('#'+pageId).addClass('active');*/


					</script>
					
					
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
						/*$('input:image').click(function() {
							alert($(this).val());
						});
						style="float: right;" 
						*/
						
						function toggleBox(msgBox){  
							//jQuery(document).ready(function(){
								var parent_id = $(msgBox).attr('id');
								jQuery(parent_id).on('click', function(event) {        
									 jQuery(parent_id).toggle('show');
								});
							//});
							//$("#btnNewGroup").click(function () {        
							//		$("#newGroup").toggle();        
										//		});
						}
						
						function f1(objButton){  
							var a = (objButton.value);
						
							 var msg_id = $(objButton).attr('id');
						
							//var name = $("input:image").val();
							
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
			$usernameSql = mysqli_query($db,"SELECT username, avatar,gravatar, profile_flag from users where username='".$login_session."'");
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
	  <script type="text/javascript">
	/*		  $('.user-menu_username').click(function()
			{
				$('.user-profile').slideToggle('fast');
			});*/
	  </script>
	  
	  <div class="input-box">
		
		<div class='menu--main' style="left:15%;position:absolute;display:inline-block;" id="formid3">
			<!--<ul class='menu--main'>
				<li>
					<input type="image" src="images/plus.png" height="20" width="20" />
					<ul class='sub-menu'>
					 <!-- <li><a href="localImage.php" style="color: black; text-decoration:none;">Local Image</a></li>
					  <li><a href="codeSnippet.php" style="color: black; text-decoration:none;">Code Snippet</a></li>-->
					 <!-- <li><a href="localImage.php" style="color: black; text-decoration:none;">Local Image</a></li>
					</ul>
				  </li>
				 </ul>-->
				<!-- <form method="post" name="input" action="localImage.php"> </form>-->
				<input type="submit" name="localImage" id=<?php echo $channel_id; ?> style="display: none; border: none; background: none;" >
				 <input type="image" src="images/attach.png" height="35" width="35" id=<?php echo $channel_id; ?> onclick="addLocalImg(this);window.location.reload();"/>
				</input>
				
				<script>
					function addLocalImg(addImg){  
					
							 var ch_id = $(addImg).attr('id');
							 //var input_val=$("#child-input-"+parent_id).val();
							// console.log(input_val);
					
							//return a;
							var d= {'ch_id':ch_id}
							$.ajax({
								type: "POST",
								url: 'localImage.php',
								 data:ch_id,
								dataType: 'text',
								success: function(data)
								{
								   // $(".voteUp").html(data);
								  // alert(data);
								   window.location = 'localImage.php?ch_id='+ch_id;
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
			if($_POST["message"] =="/archive"){
				  $arcsql = "SELECT * FROM archive WHERE channel_id = '$channel_id'";
				  $arcresult = mysqli_query($db,$arcsql);
				  $arcrow = mysqli_fetch_array($arcresult,MYSQLI_ASSOC);
				  $arccount = mysqli_num_rows($arcresult);
				  
				  if($arccount == 0) {
				$archiveSql = "INSERT INTO archive (channel_id,channel_name) VALUES ('".$channel_id."','".$channelNm['channel_name']."')";
			
				if ($db->query($archiveSql) === TRUE) {
				
					$error=" Channel is archived";
				} else {
				
					$error = "Error in archiving";
				}
				  }
			}
			else if($_POST["message"] =="/who"){
				  $whoUsers = "/who ";
				  $membersql = "SELECT username from membership where channel_name='".$channelNm['channel_name']."' AND username != '".$login_session."' ";
				  $memberresult = mysqli_query($db,$membersql);
				  $membercount = mysqli_num_rows($memberresult);
				  if($membercount != 0){
					  while($memberrow = mysqli_fetch_array($memberresult,MYSQLI_ASSOC))
					  {
						  $whoUsers .=  $memberrow['username'];
						  $whoUsers .= ", ";
					  }
					  $whoUsers .=" and you.";
				  }
				  else{
					$whoUsers .=" Only you.";
					}
				  $whoUsersql = "INSERT INTO msg (channel_id, username, timestamp, message)
					VALUES ('".$channel_id."','".$login_session."','".$date."','".addslashes(htmlspecialchars($whoUsers))."')";
					
					
			
				if ($db->query($whoUsersql) === TRUE) {
				//echo "New record created successfully";
				} else {
				//echo "Error: " . $sql . "<br>" . $db->error."";
				}
				  
			}
			
			else if(substr( $_POST["message"], 0, 4 ) === "/msg" && ($_POST["message"]{5} === "@")){
				  $userNm = explode(" ", $_POST["message"]);
				  $userNm = ltrim($userNm[1], '@');
				   //echo $userNm; // piece1
				  $messageNm= substr( $_POST["message"], 6);
				 $finalMsg = ltrim($messageNm, $userNm);
				//echo $finalMsg;
 				  $usersql = "SELECT * FROM users WHERE username = '$userNm'";
				  $userresult = mysqli_query($db,$usersql);
				  $userrow = mysqli_fetch_array($userresult,MYSQLI_ASSOC);
				  $usercount = mysqli_num_rows($userresult);
				  
				  if($usercount == 1) {
					$botDmSql = "INSERT INTO direct_message (sender, receiver, timestamp, dm_message)
					VALUES ('".$login_session."','".$userNm."','".$date."','".addslashes(htmlspecialchars($finalMsg))."')";
				
				if ($db->query($botDmSql) === TRUE) {
					header("location:directMessage.php?id=$channel_id&sender=$login_session&receiver=$userNm");
					$error=" message is inserted";
				} else {
				
					$error = "Error in inserting";
				}
				  }
			}
			
			else{
			
				$sql = "INSERT INTO msg (channel_id, username, timestamp, message)
				VALUES ('".$channel_id."','".$login_session."','".$date."','".addslashes(htmlspecialchars($_POST["message"]))."')";
				
				
		
			if ($db->query($sql) === TRUE) {
			//echo "New record created successfully";
			} else {
			//echo "Error: " . $sql . "<br>" . $db->error."";
			}
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
