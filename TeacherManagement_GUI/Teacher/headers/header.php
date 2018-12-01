<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
	<script type="text/javascript">

        $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 5000);

        });
    </script>
</head>

<body>
<?php
    ob_start();
    session_start();
   // if (!isset($_SESSION['username'])){
    //    header("Location: http://localhost:8888/TeacherManagement/login.php");
   // }
  //  $username = $_SESSION["username"];
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
                    <a href="http://localhost:8888/TeacherManagement/Teacher/schedule.php">
                        <i class="pe-7s-note2"></i>
                        <p>Teaching Schedule</p>
                    </a>
                </li>
                <li>
                    <a href="http://localhost:8888/TeacherManagement/Teacher/salary.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Personal Salary</p>
                    </a>
                </li>
				<li>
                    <a href="http://localhost:8888/TeacherManagement/Teacher/salary_chart.php">
                        <i class="pe-7s-graph"></i>
                        <p>Salary Chart</p>
                    </a>
                </li>
                <li>
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
                    <a class="navbar-brand" href="#" style="color:black">Teacher Account</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p><?php echo $_SESSION['username']?></p>
                            </a>
                        </li>
                        <li>
                            <a href="http://localhost:8888/TeacherManagement/Teacher/TeacherLogout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>