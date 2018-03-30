<?php
 //echo $_GET['d1'];
 //echo "hello";
// include('config.php');
 include('session.php');
 ob_start();
 if(isset($_POST["parent_id"])){
				
				//$vote1 = $POST['d2'];
				//echo $vote1;
				//$vote_val=intval($vote1['vote']);
				$parent_id = intval($_POST['parent_id']);
				$child_msg = $_POST['input_val'];
			//	echo $val, $parent_id;
				date_default_timezone_set('America/New_York');
				$date = date('Y-m-d H:i:s');
				
			if (strlen($child_msg) != 0)	{			
				$sql = "INSERT INTO replies (msg_id, child_msg, username, timestamp)
						VALUES ('".$parent_id."','".addslashes(htmlspecialchars($child_msg))."','".$login_session."','".$date."')";
							
							echo $sql;
					
						if ($db->query($sql) === TRUE) {
						echo "New record created successfully";
						} else {
						echo "Error: " . $sql . "<br>" . $db->error."";
						}
						
					/*	$get_msgid = "SELECT reply_id from replies where timestamp='".$date."' AND child_msg='".addslashes(htmlspecialchars($child_msg))."'";
						$result1 = mysqli_query($db,$get_msgid);
						$row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
							
					//	echo $row1["reply_id"];
						//}
						$vSql = "INSERT INTO child_voting_count (username, vote_up, child_msg_id,up_count, down_count)
							VALUES ('".$login_session."','0','".$row1["reply_id"]."','0','0')";
							if ($db->query($vSql) === TRUE){echo "New record created successfully";}
							else {
						echo "Error: " . $vSql . "<br>" . $db->error."";
						}
						*/
						header("Refresh: 0");
						exit;
				
 }
				
				echo json_encode([$parent_id, $row1["child_msg_id"]]);
				
 }
?>
