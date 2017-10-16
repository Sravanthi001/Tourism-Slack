<?php
 //  include("session.php");
   include("config.php");
   session_start();
   ob_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
	//   $_SESSION['login_user'] = $myusername;
      $sql = "SELECT user_id FROM users WHERE BINARY username = BINARY '$myusername' and BINARY password = BINARY '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['user_id'];
      
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
	
	   
	//header("location: chatPage.php");
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: chatPage.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Slack for Tourism</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" href="css/login-style.css">

  
</head>

<body class="login-wrap">
  <div>
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
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
					<br><br>
					<div class="group">
						<input type="submit" class="button" value="Sign In">
					</div>
					<div class="hr"></div>
					<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				</form>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
