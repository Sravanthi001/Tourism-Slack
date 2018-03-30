<?php
include('session.php');
 if(isset($_GET['notification_id']) ){
				
				$error="";
				$notification_id = $_GET['notification_id'];
				
		
				$deleteinvite = mysqli_query($db,"DELETE from invitation where invite_id= '".$notification_id."'");
				$inviteData = mysqli_fetch_array($getData, MYSQLI_ASSOC);
				
				echo "Invite declined";

				echo json_encode([$notification_id]);
 }		

?>