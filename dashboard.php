<?php
include('session.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tourism Slack</title>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 

</head>

<!-- Bar Chart -->
<?php
		$totalUsers= "SELECT username,user_id from users";
		$userData = mysqli_query($db,$totalUsers);
		$userTotal = 0;
?>					
<script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['User Name', 'Total Posts'],  
                          <?php 							
							while($users = mysqli_fetch_array($userData)){
								
								$i= $users['user_id'];
								$u[$i] = "";
								$msgcountSql = mysqli_query($db,"SELECT COUNT(message) AS usermsg_count from msg where username='".$users['username']."'");
								$usermsg_count1 = mysqli_fetch_array($msgcountSql, MYSQLI_ASSOC);
								
								$usermsg_count = $usermsg_count1['usermsg_count'];
								
								//reply msg count
								$replycountSql = mysqli_query($db,"SELECT COUNT(child_msg) AS userreply_count from replies where username='".$users['username']."'");
								$userreply_count1 = mysqli_fetch_array($replycountSql, MYSQLI_ASSOC);
								
								$userreply_count = $userreply_count1['userreply_count'];
								
								$totaluserpost = $usermsg_count + $userreply_count;
	
								$u[$i] = $totaluserpost;
								$userTotal += $u[$i];
								
								echo "['".$users['username']."', ".$u[$i]."],";  
							}
                          ?>  
                     ]);  
                var options = {  
                      //title: 'Percentage of Male and Female Employee',  
                      is3D:true,  
                      //pieHole: 0.4  
                     };  
                var chart = new google.visualization.BarChart(document.getElementById('barChart'));  
                chart.draw(data, options);  
           }  
 </script> 

<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->
	
	<?php
		$usercountSql = mysqli_query($db,"SELECT COUNT(username) AS user_count from users");
		$usercount = mysqli_fetch_array($usercountSql, MYSQLI_ASSOC);
		
		$user_count = $usercount['user_count'];
		
		$chcountSql = mysqli_query($db,"SELECT COUNT(channel_name) AS ch_count from channels");
		$chcount = mysqli_fetch_array($chcountSql, MYSQLI_ASSOC);
		
		$ch_count = $chcount['ch_count'];
	?>

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Tourism Slack
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.html">
                        <i class="pe-7s-graph"></i>
                        <p>Admin Dashboard</p>
                    </a>
                </li>
				<br>
                <li>
                    <a href="">
                        <i class="pe-7s-user"></i>
                        <p>Total Users: <?php echo $user_count; ?></p>
                    </a>
                </li>
				<br>
                <li>
                    <a href="">
                        <i class="pe-7s-note2"></i>
                        <p>Total Posts: <?php echo $userTotal; ?></p>
                    </a>
                </li>
				<br>
                <li>
                    <a href="">
                        <i class="pe-7s-science"></i>
                        <p>Total Channels: <?php echo $ch_count; ?></p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
            </div>
        </nav>
		
<!-- Pie Chart -->
<?php
		$totalChannels= "SELECT channel_name,channel_id from channels";
		$chData = mysqli_query($db,$totalChannels);
		$total = 0;
		
?>

<script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Channel Name', 'Total Posts'],  
                          <?php 							
							while($channels = mysqli_fetch_array($chData)){
								
								$i= $channels['channel_id'];
								$ch[$i] = "";
								//message count per channel
								$msgcountSql = mysqli_query($db,"SELECT COUNT(message) AS usermsg_count from msg where channel_id='".$channels['channel_id']."'");
								$usermsg_count1 = mysqli_fetch_array($msgcountSql, MYSQLI_ASSOC);
								
								$usermsg_count = $usermsg_count1['usermsg_count'];
	
								$ch[$i] = $usermsg_count;
								
								echo "['".$channels['channel_name']."', ".$ch[$i]."],";  
							}
                          ?>  
                     ]);  
                var options = {  
                      //title: 'Percentage of Male and Female Employee',  
                      is3D:true,  
                      //pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
 </script> 


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Channel Statistics</h4>
								<p class="category">Posts in all channels.</p>
                            </div>
                            <div class="content">
                                <div id="piechart" class="ct-chart ct-perfect-fourth" style="width: 280px; height: 290px;"></div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Posts count till today.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

					

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users Statistics</h4>
                                <p class="category">Users total posts in all channels.</p>
                            </div>
                            <div class="content">
                                <div id="barChart" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="legend">
                                       
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Posts count till today.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <!--<nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>-->
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin   -->
    <script src="assets/js/bootstrap-notify.js"></script> 

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	/*$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });*/

    	});
	</script>

</html>
