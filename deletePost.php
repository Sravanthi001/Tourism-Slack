<?php

 include('session.php');
 ob_start();
 if(isset($_POST["parent_id"]) ){
				
				$parent_id = intval($_POST['parent_id']);
					
				$sql = "Delete FROM msg where msg_id=$parent_id";		
						//	echo $sql;
					
						if ($db->query($sql) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $sql . "<br>" . $db->error."";
						}
						
				$childsql = "Delete FROM replies where msg_id=$parent_id";	
				if ($db->query($childsql) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $childsql . "<br>" . $db->error."";
						}
						
				$voting = "Delete FROM voting_count where msg_id=$parent_id";	
				if ($db->query($voting) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $childsql . "<br>" . $db->error."";
						}
						header("Refresh: 0");
						exit;
			
				echo json_encode([$parent_id]);
				
 }
 
 
 if(isset($_POST["child_id"]) ){
				
				$child_id = intval($_POST['child_id']);
					
				$sql = "Delete FROM replies where reply_id=$child_id";		
						//	echo $sql;
					
						if ($db->query($sql) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $sql . "<br>" . $db->error."";
						}
						
				$child_voting = "Delete FROM child_voting_count where child_msg_id=$child_id";		
				if ($db->query($child_voting) === TRUE) {
					//	echo "New record deleted successfully";
						} else {
					//	echo "Error: " . $childsql . "<br>" . $db->error."";
						}
						header("Refresh: 0");
						exit;
			
				echo json_encode([$child_id]);
				
 }
?>
