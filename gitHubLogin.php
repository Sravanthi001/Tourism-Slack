<?php
session_start();
include("config.php");

if(isset($_GET['code']))
    {
$code = $_GET['code'];
echo $code;
		$httpArray = http_build_query(array(
				
					//localhost Credentials
					/*'client_id' => 'bb8dfc7bc8b3e33f715f',
                    'redirect_url' => 'http://localhost:8080/cs518/MyProjectWork/CS518-WebProgramming-master/gitHubLogin.php',
					'client_secret' => 'c3459d20060aa2231728e4b44cc2a61818025648',
					*/
					//Docker Credentials
					'client_id' => 'b73ff4fc32f91d6d8c4a',
				   'redirect_url' => 'http://prajaktakanade.cs518.cs.odu.edu/gitHubLogin.php',
					'client_secret' => 'ae141177f1cbd74605e2f36f538b897153e329e0',
					'code' => $code,
            ));
		
		$streamContext = stream_context_create(
                array(
                    "http" => array(
                        "method" => "POST",
                        'header'=> "Content-type: application/x-www-form-urlencoded\r\n" .
                                    "Content-Length: ". strlen($httpArray) . "\r\n".
                                    "Accept: application/json" ,  
                        "content" => $httpArray,
                    )
                )
            );
			
		$json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $streamContext);
        //echo $json_data;
		
			$decodeData = json_decode($json_data , true);
            $access_token = $decodeData['access_token'];
            $scope = $decodeData['scope']; 
            $url = "https://api.github.com/user?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $streamContext  = stream_context_create($options);
            $userDetails = file_get_contents($url, false, $streamContext); 
            $userData  = json_decode($userDetails, true);
            $_SESSION['login_user'] = $userData['login'];
            $fname = $userData['name'];
            $gravatar=$userData['avatar_url'];
			
            /* Getting User e-mail Details */                
            $url = "https://api.github.com/user/emails?access_token=".$access_token."";
            $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
            $streamContext  = stream_context_create($options);
            $emails =  file_get_contents($url, false, $streamContext);
            $email_data = json_decode($emails, true);
            $email_id = $email_data[0]['email'];
			
			echo "login: ".$_SESSION['login_user'];
			$count=0;
			$sql1 = "SELECT user_id FROM users WHERE BINARY username = BINARY '".$_SESSION['login_user']."'";
		    $result1 = mysqli_query($db,$sql1);
		    $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
		    $count = mysqli_num_rows($result1);
			echo "\n count: ".$count;
			if($count==0)
			{
				$url = 'https://www.gravatar.com/avatar/';
				$url .= md5( strtolower( trim( $email_id ) ) );
				$url .= "?s=50&d=404";
			$sql = "INSERT INTO users(fname,lname, email_id, username, password, avatar,gravatar,profile_flag) VALUES ('".$fname."','','".$email_id."','".$_SESSION['login_user']."','','".$gravatar."','".$url."',0)";
				if($db->query($sql) === TRUE)
				{
					echo $sql;
					//$uid=mysqli_insert_id($conn);
					//$_SESSION["uid"]=$uid;
				}
				else {
					echo "err: ".$sql;
					//$_SESSION["uid"]=0;
				}
			$defaulchSql = mysqli_query($db,"INSERT INTO membership (username,channel_name, channel_type) VALUES ('".$_SESSION['login_user']."','General','0')");
				echo $defaulchSql;						
					if ($db->query($defaulchSql) === TRUE) {
					// inserting general channel
					echo $defaulchSql;
					
					} 
			}
			else
			{
				
				$sql = "update users set avatar='".$gravatar."' where username='".$_SESSION['login_user']."' ";
				//echo $sql;
				if($db->query($sql) === TRUE)
				{
					echo $sql;
				}
				else
				{
					echo $sql;
				}
			}
					
			 header("location: chatPage.php?id=1&page=1");
	}

?>