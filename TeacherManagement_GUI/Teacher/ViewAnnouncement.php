<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ANNOUNCEMENT</title>

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
<body>
<?php
    ob_start();
    session_start();
    $username = $_SESSION["username"];
    if(isset($_GET["title"])){
        $title       = $_GET["title"];
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/TeacherManagement/ViewAnnoucement/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    //$data = array('username'=>$_SESSION['username']);
    $data = array('TITLE'=> $_GET["title"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = (array) json_decode($output);
    // Announcement information
    $title                           = $result['title'];
    $idAdmin                         = $result['idAdmin'];
    $datepost                        = $result['datepost'];
    $content                         = $result['content'];
?>
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
                    <a href="http://localhost:8888/TeacherManagement/Teacher/user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8888/TeacherManagement/Teacher/schedule.html">
                        <i class="pe-7s-note2"></i>
                        <p>Teaching Schedule</p>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8888/TeacherManagement/Teacher/salary.html">
                        <i class="pe-7s-news-paper"></i>
                        <p>Personal Salary</p>
                    </a>
                </li>
				<li>
                    <a href="http://localhost:8888/TeacherManagement/Teacher/salary_chart.html">
                        <i class="pe-7s-graph"></i>
                        <p>Salary Chart</p>
                    </a>
                </li>
                <li class="active">
                    <a href="http://localhost:8888/TeacherManagement/Teacher/announcement.php">
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
                               <p>Account</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
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
                                <h2 class="title" style="text-align:center; color:cadetblue"><?= $title?></h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <h5 style="color:tomato">Upload By: <?= $idAdmin?></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 style="color:tomato">Uploaded at: <?= $datepost?></h5>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-8">
                                        <h3><?= $content?></h3>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
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
                            <a href="schedule.html">
                                Teaching Schedule
                            </a>
                        </li>
						
						<li>
                            <a href="salary.html">
                                Personal Salary
                            </a>
                        </li>
                        <li>
                            <a href="salary_chart.html">
                               Salary Chart
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
