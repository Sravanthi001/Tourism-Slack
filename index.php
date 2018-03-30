<?php
   include("config.php");
   session_start();
   $error = "";
   $error1 = "";
   $captchaerror = "";
   $errors = [' ',' ',' ',' ',' ',' ',' ',' ',' '];
   
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sign-in"])) {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,md5($_POST['password'])); 
      
      $sql = "SELECT user_id FROM users WHERE BINARY username = BINARY '$myusername' and BINARY password = BINARY '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $admin_id = $row['user_id'];
	  echo $admin_id;
      
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1 && $admin_id != '1') {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: chatPage.php?id=1&page=1");
      }
	  else if($count == 1 && $admin_id == '1')
	  {
		  $_SESSION['login_user'] = $myusername;
		  header("location: adminchatPage.php?id=1&page=1");
	  }
	  else {
         $error = "Your Login Name or Password is invalid";
      }
   }
		
   
   //sign-up code
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sign-up"])) {
		
		if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
			
			$secret = '6Le0YDsUAAAAAElTmm3yw1NZjglRJdBnG4sQ7IMf';
			
			//get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

		if($responseData->success){
	   //two passwords are equal to each other
	   
		$check_user = "SELECT username FROM users WHERE BINARY username = BINARY '".addslashes(htmlspecialchars($_POST["rusername"]))."'";
		$result = mysqli_query($db,$check_user);
		$check_email = "SELECT email_id FROM users WHERE BINARY email_id = BINARY '".addslashes(htmlspecialchars($_POST["remail"]))."'";
		$result1 = mysqli_query($db,$check_email);
		$email = $db->real_escape_string(htmlspecialchars($_POST['remail']));
		$rpassword = $_POST['rpassword']; 
		$rrpassword = $_POST['rrpassword'];
		
		$md5email = md5( strtolower( trim( $email ) ) );
		
		$url = 'https://www.gravatar.com/avatar/';
		$url .= $md5email;
		$url .= "?s=50&d=404";
		
		if (mysqli_num_rows($result) != 0)
		{
		  $errors[0] =  "Username already exists";
		}
		 
		if (mysqli_num_rows($result1) != 0)
		{
		  $errors[1] =  "Email already exists";
		}
		
		 else if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			{
				$errors[7] = "Invalid email.";			
			}
		
		else if ($_POST['rpassword'] == $_POST['rrpassword']) {
			
			if(!preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/', $rpassword)) {
				 //var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
				
				$errors[8] = "the password does not meet the requirements!";
			}
			
			else{
			//set all the post variables
			$fname = $db->real_escape_string(htmlspecialchars($_POST['rfname']));
			$lname = $db->real_escape_string(htmlspecialchars($_POST['rlname']));
			$username = $db->real_escape_string(htmlspecialchars($_POST['rusername']));
				
				$dir = '/msg-profile.png';
			
	   //     $avatar_path = $db->real_escape_string(htmlspecialchars('images/'.$_FILES['avatar']['name']));
			
			//make sure the file type is image
		//    if (preg_match("!image!",$_FILES['avatar']['type'])) {
				
				//copy image to images/ folder 
			//    if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
					
					//set session variables
					$_SESSION['username'] = $username;
				  //  $_SESSION['avatar'] = $avatar_path;
					//insert user data into database
					$sql = "INSERT INTO users (fname, lname, username, email_id, password, avatar, gravatar) "
							. "VALUES ('".addslashes($fname)."', '".addslashes($lname)."', '".addslashes($username)."', '".addslashes($email)."', '".md5(addslashes($rpassword))."', '".addslashes($dir)."','".addslashes($url)."')";
					
					
					//if the query is successsful, redirect to welcome.php page, done!
					if ($db->query($sql) === TRUE){
						//$_SESSION['message'] = "Registration succesful! Added $username to the database!";
						$error1 = "Registration succesful! Added  to the database!";
					 //   header("location: index.php");
					}
					else {
						$errors[2] = 'User could not be added to the database!';
					}
					
					
					$defaulchSql = mysqli_query($db,"INSERT INTO membership (username,channel_name, channel_type) VALUES ('".addslashes($username)."','General','0')");
										
					if ($db->query($defaulchSql) === TRUE) {
					// inserting general channel
					
					} 
				  //  $db->close();          
			 /*   }
				else {
					$errors[3] = 'File upload failed!';
				}*/
		 /*   }
			else {
				$errors[4] = 'Please only upload GIF, JPG or PNG images!';
			}*/
			}
		}
		else {
			$errors[5] = 'Two passwords do not match!';
		}
		
		}else{
			$captchaerror = 'Robot verification failed, please try again.';
			}
	}
	else{
		$captchaerror = 'Please click on the reCAPTCHA box.';
	}
}
   
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<script type="text/javascript">
					/*		$(".sign-in").click(function()
								{
	// on li click the radio button gets cheched
									$(this).find('input[type=radio]').prop("checked", "true");
									$('form').submit();
								})*/
</script>

<!DOCTYPE HTML>
<html >
<head>
  <meta charset="UTF-8">
  <title>Slack for Tourism</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="css/login-style.css">
	
	 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script type='text/javascript'>
 	function reCaptchad(){
		document.getElementById("myButton").disabled = false;
	}
     </script>
  
</head>

<body class="login-wrap">
  <div>
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked="checked"><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<form action = "" method = "post">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" name = "username" type="text" class="input">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" name = "password" type="password" class="input" data-type="password">
					</div>
					<div class="group">
						<input id="check" type="checkbox" class="check" checked>
						<label for="check"><span class="icon"></span> Keep me Signed in</label>
					</div>
					<div class="group">
						<input name="sign-in" type="submit" class="button" value="Sign In">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<!--<a href="https://github.com/login/oauth/authorize?scope=user:email&client_id=bb8dfc7bc8b3e33f715f" style="color:#ffffff">Login with GitHub</a>-->
						<a href="https://github.com/login/oauth/authorize?scope=user:email&client_id=b73ff4fc32f91d6d8c4a" style="color:#ffffff">Login with GitHub</a>
					</div>
					<br>
					<br>
					<div class="foot-lnk">
						<a href="#forgot">Forgot Password?</a>
					</div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error1; ?></div>
				</form>
				
				
				<?php
						   // This code is for github login.
						  
							/*	require_once('githubConfig.php');
								//require_once('functions.php');
								if(isset($_GET['code']))
								{
									
								}
								else{
									echo '<button class="button" style="margin-left:95px;"><a  style="color:#FFFFFF;" href="https://github.com/login/oauth/authorize?scope=user:email&client_id=9bd20407e43c270c8880" title="Login with Github">Login with Github';
									 echo '</button></a>';
								}*/
				
				?>
				
				
				
			</div>
			<div class="sign-up-htm">
				<form action = "" method = "post" autocomplete="off" enctype="multipart/form-data">
					<div class="group">
						<label for="user" class="label">First Name</label>
						<input id="user" name="rfname" type="text" class="input" required >
					</div>
					<div class="group">
						<label for="user" class="label">Last Name</label>
						<input id="user" name="rlname" type="text" class="input" required >
					</div>
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" name="rusername" type="text" class="input" required >
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<div style = "font-size:9px; color:#aaa; margin-top:10px">Please enter at least 1 capital, 1 small letter and 1 number. Password length is 6-20 characters.</div>
						<input id="pass" name="rpassword" type="password" class="input" data-type="password" required >
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="pass" name="rrpassword" type="password" class="input" data-type="password" required >
					</div>
					<div class="group">
						<label for="pass" class="label">Email Address</label>
						<input id="pass" name="remail" type="text" class="input" required >
					</div>
					<!--<div class="group">
						<label for="user" class="label">Select your avatar: </label>
						<input type="file" class="input" name="avatar" accept="image/*" required />
					</div>-->
					
					<div class="g-recaptcha" data-sitekey="6Le0YDsUAAAAAKCYEeiOj_mzEIHOTSWcBK0Wr5AV" 
						data-callback="reCaptchad">
					</div>
					 
					<br><br>
					<div class="group">
						<input name="sign-up" type="submit" class="button" value="Sign Up">
						
						<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[0]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[1]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[2]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[3]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[4]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[5]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[6]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[7]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $errors[8]; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $captchaerror; ?></div>
						
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">Already Member?</a>
					</div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error; ?></div>
					<div style = "font-size:11px; color:#ffffff; margin-top:10px"><?php echo $error1; ?></div>
					
				</form>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
