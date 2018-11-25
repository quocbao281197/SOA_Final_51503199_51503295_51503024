<head>
<title>View Announcement</title>
</head>
<?php
    require_once('headers/header.php');
?>
<?php

    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }

    if(isset($_GET["title"])){
        $title       = $_GET["title"];
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/ViewAnnouncement/");
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
    $idadmin                         = $result['idadmin'];
    $datepost                        = $result['datepost'];
    $content                         = $result['content'];
?>
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
                                        <h5 style="color:tomato">Upload By: <?= $idadmin?></h5>
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
                            <a href="schedule.php">
                                Teaching Schedule
                            </a>
                        </li>
						
						<li>
                            <a href="salary.php">
                                Personal Salary
                            </a>
                        </li>
                        <li>
                            <a href="salary_chart.php">
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
