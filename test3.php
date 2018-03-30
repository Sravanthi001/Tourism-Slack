<?php
 //echo $_GET['d1'];
 //echo "hello";
 include('config.php');
 ob_start();
 if(isset($_GET['childData']) ){
				
				$vote1 = $_GET['childData'];
				//echo $vote1;
				$vote_val=intval($vote1['replyValue']);
				$msg_id = intval($vote1['child_msgid']);
			
				$up = "SELECT vote_up from child_voting_count WHERE  child_msg_id ='$msg_id'";
				$result = mysqli_query($db,$up);
				  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				  $vote = $row['vote_up'];
				 if($vote == '0'){
					  if($vote_val=='1'){
						 $count = "UPDATE child_voting_count SET up_count=up_count+1 WHERE  child_msg_id ='$msg_id' AND (vote_up='2' OR vote_up='0')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
					 else if($vote_val=='2'){
						 $count = "UPDATE child_voting_count SET down_count=down_count+1 WHERE  child_msg_id ='$msg_id' AND (vote_up='1' OR vote_up='0')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
				 } 
				 else if($vote == '1' || $vote =='2'){
					  if($vote_val=='1'){
						 $count = "UPDATE child_voting_count SET up_count=up_count+1,down_count=down_count-1 WHERE  child_msg_id ='$msg_id' AND (vote_up='2')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
					 else if($vote_val=='2'){
						 $count = "UPDATE child_voting_count SET down_count=down_count+1, up_count=up_count-1 WHERE  child_msg_id ='$msg_id' AND (vote_up='1')";
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
				 }
				
				$voteSql = "UPDATE child_voting_count SET vote_up='".addslashes($vote_val)."' WHERE  child_msg_id ='$msg_id'";
				
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
