<head>
<title>Schedule</title>
</head>
<?php
    require_once('headers/header.php');
?>
<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8888/TeacherManagement/login.php");
    }
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Please Select:</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2" style="font-size:1.5em;margin-top: 15px;">
                                            Semester:
                                        </div>
                                        <div class="col-md-8">
                                        <!-- <div class="custom-select" style="width:500px;"> -->
                                            <select name = "Semester_select" style="width: 250px;height:25px;text-align: center;background-color: #F2F2F2;border: 1px solid #E4E4E4;font-family: Arial;font-size:1.2em;margin-top: 20px;">
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2" style="font-size:1.5em;margin-top: 15px;">
                                            Year:
                                        </div>
                                        <div class="col-md-8">
                                            <select name = "Year_select" style="width: 250px;height:25px;text-align: center;background-color: #F2F2F2;border: 1px solid #E4E4E4;font-family: Arial;font-size:1.2em;margin-top: 20px;">
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class = "row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary" style="width:12%;margin-top:20px;">
                                                    View
                                                </button>
                                            </div>
                                        </div>
                                    <div>
                                </form>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['Semester_select']) && isset($_POST['Year_select'])){                            
                                $data = array('teacherID'=>$_SESSION['username'], 'semester'=>$_POST['Semester_select'], 'year'=>$_POST['Year_select']);
                                $GVID = $_SESSION['username'];
                                $Semester = $_POST['Semester_select'];
                                $Year = $_POST['Year_select'];

                                //$locationLink = "Location: TeacherSchedule/ViewSchedule.php?teacherid=". $GVID ."&semester=".$Semester."&year=". $Year ." target=\"_blank\""
                                header("Location: http://localhost:8888/TeacherManagement/Teacher/TeacherSchedule/ViewSchedule.php?teacherid=". $GVID ."&semester=".$Semester."&year=". $Year);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
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
