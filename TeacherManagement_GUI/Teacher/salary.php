<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>PERSONAL SALARY</title>

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
</head>
<?php
    ob_start();
    session_start();
    $username = $_SESSION['username'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/TeacherManagement/ViewSalary/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array('ID'=>$_SESSION['username']);
    //$data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Salary = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $test = (array)json_decode($array_Salary,true);
    //print_r($test);
?>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Teacher Management System
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="schedule.php">
                        <i class="pe-7s-note2"></i>
                        <p>Teaching Schedule</p>
                    </a>
                </li>

				<li class="active">
                    <a href="salary.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Personal Salary</p>
                    </a>
                </li>

				<li>
                    <a href="salary_chart.php">
                        <i class="pe-7s-graph"></i>
                        <p>Salary Chart</p>
                    </a>
                </li>



                <li>
                    <a href="announcement.php">
                        <i class="pe-7s-bell"></i>
                        <p>Announcement</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="color:red">Teacher Account</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p><?=$_SESSION["username"]?></p>
                            </a>
                        </li>
                        <li>
                            <a href="TeacherLogout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="text-align:center; color:purple">Salary Table</h4>
                            </div>
                            <div class="content">
                                <div class = "row">
                                    <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;">Month</div>
                                    <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;">Year</div>
                                    <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;">Salary</div>
                                </div>
                                <hr>
                                <?php
                                    foreach($test as $a){
                                        
                                    ?> 
                                    <div class="row">
                                        <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;"><?= $a['month']?></div>
                                        <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;"><?= $a['year']?></div>
                                        <div class = "col-md-4" style="margin:auto; padding-bottom: 25px;"><?= $a['total']?></div>
                                    </div>
                                    <hr>
                                    <?php
                                    }
                                ?>
                            </div>
							<form method="post" action="salary_chart.php">
								<button class="btn btn-info btn-fill pull-left" type = "submit" href="salary_chart.php">View Salary Chart</button>
							</form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="user.php">
                                User Profile
                            </a>
                        </li>
                        <li>
                            <a href="schedule.php">
                                Teaching Schedule
                            </a>
                        </li>
						
						<li>
                            <a href="salary_chart.php">
                                Salary Chart
                            </a>
                        </li>
                        <li>
                            <a href="announcement.php">
                               Announcement
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                </p>
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

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
