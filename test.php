<?php
 //echo $_GET['d1'];
 //echo "hello";
 //include('config.php');
 include('session.php');
 ob_start();
 if(isset($_GET['d1']) ){
				
				$vote1 = $_GET['d1'];
				//echo $vote1;
				$vote_val=intval($vote1['vote']);
				$msg_id = intval($vote1['msg_id']);
			
				$up = "SELECT vote_up from voting_count WHERE  msg_id ='$msg_id'";
				$result = mysqli_query($db,$up);
				  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				  $vote = $row['vote_up'];
				  
				  $up1 = "SELECT username from msg WHERE  msg_id ='$msg_id'";
				$result1 = mysqli_query($db,$up1);
				  $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
				  $username = $row1['username'];
				  
				  echo $username;
				 if($vote == '0'){
					  if($vote_val=='1'){
					//	 $count = "UPDATE voting_count SET up_count=up_count+1 WHERE  msg_id ='$msg_id' AND (vote_up='2' OR vote_up='0')";
						 $count = "INSERT INTO voting_count (username,userreponded,vote_up,msg_id,up_count,down_count)
												VALUES ('".$username."','".$login_session."','".$vote_val."','".$msg_id."','1','0')";
						 
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id,$username]);
					 }
					 
					 else if($vote_val=='2'){
						// $count = "UPDATE voting_count SET down_count=down_count+1 WHERE  msg_id ='$msg_id' AND (vote_up='1' OR vote_up='0')";
						$count = "INSERT INTO voting_count (username,userreponded,vote_up,msg_id,up_count,down_count)
												VALUES ('".$username."','".$login_session."','".$vote_val."','".$msg_id."','1','0')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
				 } 
				 else if($vote == '1' || $vote =='2'){
					  if($vote_val=='1'){
						 $count = "UPDATE voting_count SET up_count=up_count+1,down_count=down_count-1 WHERE  msg_id ='$msg_id' AND (vote_up='2')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
					 else if($vote_val=='2'){
						 $count = "UPDATE voting_count SET down_count=down_count+1, up_count=up_count-1 WHERE  msg_id ='$msg_id' AND (vote_up='1')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
				 }
				
				$voteSql = "UPDATE voting_count SET vote_up='".addslashes($vote_val)."' WHERE  msg_id ='$msg_id'";
				
				//echo $voteSql;
				if ($db->query($voteSql) === TRUE) {
					//echo "new record inserted";
				header("Refresh:0");
				exit;
				}
				else{
					//echo "error in inserting";
				}
				echo json_encode([$vote_val,$msg_id]);
				
 }
?>
