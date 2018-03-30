<?php
	include('config.php');
	$user= $_GET['user'];
	//echo $user;
	$sql = "SELECT fname, lname, username, email_id, avatar,gravatar,profile_flag FROM users where username ='". $user. "'";
	//echo $sql;
	$retval = mysqli_query($db,$sql);
		  
		if(! $retval ) {
		  die('Could not get data: ');
	    }
	   $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
	   
	   
	/*    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $row["email_id"] ) ) );
    $url .= "?s=50&d=404";*/
?>


<?php	   
	   
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Back"])) {
		if($user == 'Admin'){
			header("location: adminchatPage.php?id=1&page=1");
		}
		else{
		header("location: chatPage.php?id=1&page=1");
		}
   }
	   
?>

<?php 
		//SELECT message, count(*) as number FROM msg WHERE username= 'Admin' GROUP BY DATE(timestamp) ;
			$graphSql = "SELECT DATE(timestamp), message, count(*) as number FROM msg where username= '". $user. "' GROUP BY DATE(timestamp)  
						UNION ALL SELECT DATE(timestamp), child_msg, count(*) as number FROM replies where username= '". $user. "' GROUP BY DATE(timestamp)"; 
			$graphData = mysqli_query($db,$graphSql);
			$chart_data = '';
			while($graph = mysqli_fetch_array($graphData))
			{
			 $chart_data .= "{ timestamp:'".$graph["DATE(timestamp)"]."', number:".$graph["number"]."}, ";
			}
			$chart_data = substr($chart_data, 0, -2);
			
			
		//// like and dislike count
		$testSql = mysqli_query($db,"SELECT SUM(up_count) AS like_count from voting_count where userresponded='".$user."'");
		$likecount = mysqli_fetch_array($testSql, MYSQLI_ASSOC);
		
		$like_count = $likecount['like_count'];
		
		$testSql2 = mysqli_query($db,"SELECT SUM(down_count) AS dislike_count from voting_count where userresponded='".$user."'");
		$dislikecount = mysqli_fetch_array($testSql2, MYSQLI_ASSOC);
		
		$dislike_count = $dislikecount['dislike_count'];
		
		$testSql3 = mysqli_query($db,"SELECT SUM(up_count) AS c_like_count from child_voting_count where userresponded='".$user."'");
		$likecountC = mysqli_fetch_array($testSql3, MYSQLI_ASSOC);
		
		$c_like_count = $likecountC['c_like_count'];
		//$getCount = "SELECT up_count, down_count from voting_count";
		
		$testSql4 = mysqli_query($db,"SELECT SUM(down_count) AS c_dislike_count from child_voting_count where userresponded='".$user."'");
		$dislikecountC = mysqli_fetch_array($testSql4, MYSQLI_ASSOC);
		
		$c_dislike_count = $dislikecountC['c_dislike_count'];
		
		$total_like = $like_count + $c_like_count;
		$total_dislike = $dislike_count + $c_dislike_count;
		
		/// Messages count
		$msgcountSql = mysqli_query($db,"SELECT COUNT(message) AS usermsg_count from msg where username='".$user."'");
		$usermsg_count1 = mysqli_fetch_array($msgcountSql, MYSQLI_ASSOC);
		
		$usermsg_count = $usermsg_count1['usermsg_count'];
		
		//reply msg count
		$replycountSql = mysqli_query($db,"SELECT COUNT(child_msg) AS userreply_count from replies where username='".$user."'");
		$userreply_count1 = mysqli_fetch_array($replycountSql, MYSQLI_ASSOC);
		
		$userreply_count = $userreply_count1['userreply_count'];
		
		$totaluserpost = $usermsg_count + $userreply_count;
		
		/// channels count
		$channelcountSql = mysqli_query($db,"SELECT COUNT(channel_name) AS userchnl_count from channels where channel_owner='".$user."'");
		$userchnl_count1 = mysqli_fetch_array($channelcountSql, MYSQLI_ASSOC);
		
		$userchnl_count = $userchnl_count1['userchnl_count'];
		
		
		// user total of reactions , msgs , channels -
		$userdata = $total_like + $total_dislike + $totaluserpost + $userchnl_count;
		
		
		//Total count of reactions  - all like and dislike count for all the users
		
		$totallikeSql = mysqli_query($db,"SELECT SUM(up_count) AS totallike_count from voting_count" );
		$tlikecount = mysqli_fetch_array($totallikeSql, MYSQLI_ASSOC);
		
		$totallike_count = $tlikecount['totallike_count'];
		
		$totaldislikeSql = mysqli_query($db,"SELECT SUM(down_count) AS totaldislike_count from voting_count");
		$tdislikecount = mysqli_fetch_array($totaldislikeSql, MYSQLI_ASSOC);
		
		$totaldislike_count = $tdislikecount['totaldislike_count'];
		
		$totalchildlikeSql = mysqli_query($db,"SELECT SUM(up_count) AS totalc_like_count from child_voting_count ");
		$tlikecountC = mysqli_fetch_array($totalchildlikeSql, MYSQLI_ASSOC);
		
		$totalc_like_count = $tlikecountC['totalc_like_count'];
		//$getCount = "SELECT up_count, down_count from voting_count";
		
		$totalchilddislikeSql = mysqli_query($db,"SELECT SUM(down_count) AS totalc_dislike_count from child_voting_count");
		$tdislikecountC = mysqli_fetch_array($totalchilddislikeSql, MYSQLI_ASSOC);
		
		$totalc_dislike_count = $tdislikecountC['totalc_dislike_count'];
		
		$totalreactions = $totallike_count + $totaldislike_count + $totalc_like_count+ $totalc_dislike_count ;
		
		
		///// TOTAL message count in the table
		
		/// total Messages count
		$tmsgcountSql = mysqli_query($db,"SELECT COUNT(message) AS tmsg_count from msg");
		$tmsg_count1 = mysqli_fetch_array($tmsgcountSql, MYSQLI_ASSOC);
		
		$tmsg_count = $tmsg_count1['tmsg_count'];
		
		// total reply msg count
		$treplycountSql = mysqli_query($db,"SELECT COUNT(child_msg) AS treply_count from replies ");
		$treply_count1 = mysqli_fetch_array($treplycountSql, MYSQLI_ASSOC);
		
		$treply_count = $treply_count1['treply_count'];
		
		// parent and child messages total
		$totalposts = $tmsg_count + $treply_count;
		
		/// Total channels count
		$tchannelcountSql = mysqli_query($db,"SELECT COUNT(channel_name) AS tchnl_count from channels");
		$tchnl_count1 = mysqli_fetch_array($tchannelcountSql, MYSQLI_ASSOC);
		
		$tchnl_count = $tchnl_count1['tchnl_count'];
		
		
		$totaldata = $totalreactions  + $totalposts + $tchnl_count;
		
		$userrank = $userdata  / $totaldata;
		$percent =  $userrank * 100;
		
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
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  
	
	
  
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
		
				$header_response = get_headers($row['gravatar'], 1);
				if($header_response[0]!== "HTTP/1.1 404 Not Found" && $row['profile_flag'] == 1)
					{		
		?>
		<img class="photo" src="<?php echo htmlspecialchars($row['gravatar']); ?>" />
		
		<?php
				
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
				<!--<label for="user" class="number-stat">Change your avatar: </label>
				<br></br>
				<input type="file" class="desc-stat" name="avatar" accept="image/*" />
				<br></br>
				<input name="update_profile" type="submit" class="button" value="Update Profile">-->
			</div>
         
        </div>
   
     <div class="social">
			<!--<input name="Back" type="submit" class="button" value="Back">-->
      
        </div>
		
      </div>
      <div class="right col-lg-8">
	  
        <ul class="nav">
          <li>Groups</li>
          
		  <div class="row gallery">
		 </ul>
          <!--<div class="col-md-4">-->
		  <?php
				$getChannels = "SELECT channel_name FROM membership WHERE username= '". $user. "' AND channel_type=0";
				$getData = mysqli_query($db,$getChannels);
		  
				if(! $getData ) {
				  //die('Could not get data: ');
				}
				$chnameArray = array();
			  // $data = mysqli_fetch_array($getData, MYSQLI_ASSOC);
			   while($data = $getData->fetch_array()){
		  ?>
		  
          
         <!-- <li>Groups</li>
          <li>About</li>-->
        
       <!-- <span class="follow">Follow</span> -->
        
				</br><?php echo $data['channel_name'];?>
         <!-- </div>-->
        
		<?php
			   }
			   ?>
		  
		  
		  
			   <div class="nav">
				<!-- For graph -->
					<li>Activity : </li>
					<ul class="nav">
			   
          <li>USER RANK </li>
		  
		  <?php
		  
		  if ($percent < 35){
			  ?>
			 
			 <li ><img src="images/bronze.jpg " height="35" width="35"/> </li>
			 
		     <!--<li><b>bronze user</b></li> -->
		   
		  
		  <?php
		  }
		  else if ($percent < 65){
			  ?>
			  <li ><img src="images/silver.jpg " height="50" width="50"/></li>
		     <!--<li > you are a silver user </li>-->
		  <?php
		  }
		  else if ($percent > 65){
			  ?>
			  <li ><img src="images/gold.jpg " height="50" width="50"/></li>
			  <!--<li > you are a gold user </li>-->
			   <?php
		  }
		  ?>
		  
		   </ul>
					
					<div class="container" style="width:600px; height:300px;">
						<h4 align="center">Daily message posting by <?php echo $user; ?></h4>
					   <br /><br />
					   <div id="chart" style="width:500px; height:200px;"></div>
					  </div>
								   </div>
								   <script type="text/javascript">  
							  Morris.Line({
								 element : 'chart',
								 data:[<?php echo $chart_data; ?>],
								 xkey:['timestamp'],
								 ykeys:['number'],
								 labels:['Total post'],
								 hideHover:'auto',
								 stacked:true
								});
							   </script> 
							   
							   <div id="2" style="height: 200px; width:350px; ">
		   <ul class="p">
		   <li class="nav"><b>Posts Liked  : &nbsp &nbsp 
		   <?php echo $total_like; ?> </b></li>
		   </ul>
		   <ul class="p">
          <li class="nav"><b>Posts Disliked  :&nbsp &nbsp
		  <?php echo $total_dislike; ?></b></li>
		   </ul>
			   
			
		  </div>
			</div>
      </div>
	  </form>
  </main>
</div>
</body>

</html>


