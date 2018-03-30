<?php

 include('session.php');
 ob_start();
 if(isset($_POST["remove_id"]) ){
				
				$remove_id = intval($_POST['remove_id']);
					
			/*	------------------TO DO--------------------
				$getData = mysqli_query($db,"SELECT * FROM membership where member_id=$remove_id");	
				$getd = mysqli_fetch_array($getData, MYSQLI_ASSOC);
				$getCh = $getd['channel_name'];
				$getuser = $getd['username'];*/
				
				$sql = "Delete FROM membership where member_id=$remove_id";		
						//	echo $sql;
					
						if ($db->query($sql) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $sql . "<br>" . $db->error."";
						}
						
					//	header("Refresh: 0");
					//	exit;
			
				echo json_encode([$remove_id]);
				
 }

 
 if(isset($_POST["channel_name"]) ){
		$ch_name = $_POST['channel_name'];
		$user_name = $_POST['username'];
		
		$getChTypeSql = mysqli_query($db,"SELECT channel_type FROM channels where channel_name='".$ch_name."' ");
		$getCh = mysqli_fetch_array($getChTypeSql, MYSQLI_ASSOC);
		$getChType = $getCh['channel_type'];
		
		$addmemsql = "INSERT INTO membership ( username, channel_name, channel_type)
				VALUES ('".$user_name."','".$ch_name."','".$getChType."')";
					
						if ($db->query($addmemsql) === TRUE) {
					//	echo "New record deleted successfully";
					
						}
		
				echo json_encode([$user_name,$ch_name]);
 }
?>
