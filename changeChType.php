<?php

 include('session.php');
 ob_start();
if(isset($_POST["ch_type"]) ){
				
				$ch_type = $_POST['ch_type'];
					
				$privateSql = "UPDATE channels SET channel_type='1' WHERE  channel_name ='".$ch_type."' ";
				echo $privateSql;
				$db->query($privateSql);
				
				$privateSql1 = "UPDATE membership SET channel_type='1' WHERE  channel_name ='".$ch_type."' ";
				$db->query($privateSql1);
			
				echo json_encode([$ch_type]);
				
 }
 
 if(isset($_POST["ch_type1"]) ){
				
				$ch_type = $_POST['ch_type1'];
					
				$privateSql = "UPDATE channels SET channel_type='0' WHERE  channel_name ='".$ch_type."' ";
				echo $privateSql;
				$db->query($privateSql);
				
				$privateSql1 = "UPDATE membership SET channel_type='0' WHERE  channel_name ='".$ch_type."' ";
				$db->query($privateSql1);
			
				echo json_encode([$ch_type]);
				
 }
 ?>