<?php
include('session.php');
 if(isset($_GET['notification_id']) ){
				
				$error="";
				$notification_id = $_GET['notification_id'];
				//echo $notification_id;
				
				$getData = mysqli_query($db,"SELECT * FROM invitation where invite_id= '".$notification_id."'");
				$inviteData = mysqli_fetch_array($getData, MYSQLI_ASSOC);
				//echo $inviteData['channel_name'];

				
				$getchType = mysqli_query($db,"SELECT channel_type from channels where channel_name='".$inviteData['channel_name']."' ");
				//echo $getchType;
				$chnameData = mysqli_fetch_array($getchType, MYSQLI_ASSOC);
															//echo $chnameData['channel_type'];
															
				$inviteSql = mysqli_query($db,"INSERT INTO membership (username,channel_name, channel_type) VALUES ('".$login_session."','".$inviteData['channel_name']."','".$chnameData['channel_type']."')");
									
				if ($db->query($inviteSql) === TRUE) {
				//echo "Invitation sent. New record created successfully";
				$error=" Invitation sent";
				
				} else {
				echo  $inviteSql  ;
				$error = "Error in inviting";
				}
				
				echo $error;
				
				$deleteinvite = mysqli_query($db,"DELETE from invitation where invite_id= '".$notification_id."'");
				$inviteData = mysqli_fetch_array($getData, MYSQLI_ASSOC);

				echo json_encode([$notification_id]); 
 }		

?>
