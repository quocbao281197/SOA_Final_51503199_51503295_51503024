<head>
<title>Announcement</title>
</head>
<?php
    require_once('headers/header.php');
?>

<body>
<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/TeacherManagement/GetListAnnouncement/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    //$data = array('username'=>$_SESSION['username']);
    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Announcement = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $test = (array)json_decode($array_Announcement,true);
?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="text-align:center; color:purple;font-size:2em">Announcement</h4>
                            </div>
                            <div class="content">
                                <?php
                                    foreach($test as $a){
                                        
                                    ?> 
                                        <div class="typo-line">
                                        <p class="category" style ="max-width:300px"><?= substr($a['datepost'], 0, 10);?></p>
                                        <a class="text-info" style ="cursor:pointer;" href="ViewAnnoucement.php?title=<?=$a['title']?>">
                                            <?= $a['title']?>
                                        </a>
                                </div>
                                    <?php
                                    }
                                ?>
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
