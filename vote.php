<?php
 //echo $_GET['d1'];
 //echo "hello";
 //include('config.php');
 include('session.php');
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
				  
				  $checking = "SELECT id from voting_count WHERE  msg_id ='$msg_id' AND userresponded = '$login_session'"; 
				  $result2 = mysqli_query($db,$checking);
				  $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
				  $id = $row2['id'];
				  
				  $count_id = mysqli_num_rows($result2);
				  if($count_id != 0)
				  {
					  
					 // if($vote == '0'){
							if($vote_val=='1'){
						 $count = "UPDATE voting_count SET up_count= '1' ,down_count = '0' WHERE  id ='$id' AND (vote_up='2' OR vote_up='0')";
						 
						 
						$db->query($count);
						
						
						//echo json_encode([$vote_val,$msg_id,$username]);
						
						
						$voteSql = "UPDATE voting_count SET vote_up='".addslashes($vote_val)."' WHERE  id ='$id'";
				
						//echo $voteSql;
						if ($db->query($voteSql) === TRUE) {
							//echo "new record inserted";
						//header("Refresh:0");
						//exit;
						}
						else{
							//echo "error in inserting";
						}
						echo json_encode([$vote_val,$msg_id]);
					//}
				 
						
					 }
					 
						else if($vote_val=='2'){
						 $count = "UPDATE voting_count SET down_count='1' , up_count ='0' WHERE  id ='$id' AND (vote_up='1' OR vote_up='0')";
						
						$db->query($count);
						
						
						$voteSql = "UPDATE voting_count SET vote_up='".addslashes($vote_val)."' WHERE  id ='$id'";
				
						//echo $voteSql;
						if ($db->query($voteSql) === TRUE) {
							//echo "new record inserted";
						//header("Refresh:0");
						//exit;
						}
						else{
							//echo "error in inserting";
						}
						echo json_encode([$vote_val,$msg_id]);
					 }
					 
					 
					 
				
					
				  }
				  else if($count_id == 0){
					  
					  if($vote_val=='1'){
						 
						 $count = "INSERT INTO voting_count (username,userresponded,vote_up,msg_id,up_count,down_count)
												VALUES ('".$username."','".$login_session."','".$vote_val."','".$msg_id."','1','0')";
						 
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id,$username]);
					 }
					 
						else if($vote_val=='2'){
						 $count = "INSERT INTO voting_count (username,userresponded,vote_up,msg_id,up_count,down_count)
												VALUES ('".$username."','".$login_session."','".$vote_val."','".$msg_id."','0','1')";
						
						$db->query($count);
						
						
						echo json_encode([$vote_val,$msg_id]);
					 }
					  
					  				  
				  }
				  
				  
 }
?>