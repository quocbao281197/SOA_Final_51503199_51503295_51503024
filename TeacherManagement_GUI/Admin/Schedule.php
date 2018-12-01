<?php
    require_once('headers/ScheduleHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8888/TeacherManagement/login.php");
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/getListTeacherID/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_ID = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $arrID = (array)json_decode($array_ID,true);

    // get year
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/getYear/");
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
    $data = array();
    curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Year = curl_exec($ch1);
    $info = curl_getinfo($ch1);
    curl_close($ch1);
    $arrYear = (array)json_decode($array_Year,true);
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>View Teacher Schedule:</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" accept-charset="UTF-8">
  
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Teacher ID:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="GV_select" id="GV" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <?php
                                                            foreach($arrID as $item){
                                                                ?>
                                                                    <option value="<?= $item?>"><?= $item?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Semester:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Semester_select" id="Semester" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <option value="I">I</option>
                                                        <option value="II">II</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Year:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Year_select" id="Year" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <?php
                                                            foreach($arrYear as $y){
                                                                ?>
                                                                    <option value="<?= $y?>"><?= $y?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    View
                                                </button>
                                                <button style="background-color: #4CAF50" class="btn btn-primary btn-sm">
                                                    <i class="zmdi zmdi-plus"></i><a href="http://localhost:8888/TeacherManagement/Admin/Add_New_Schedule.php" style="color:white">Add</a>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php

                            if(isset($_POST['GV_select']) && isset($_POST['Semester_select']) && isset($_POST['Year_select'])){                            
                                $data = array('teacherID'=>$_POST['GV_select'], 'semester'=>$_POST['Semester_select'], 'year'=>$_POST['Year_select']);
                                $GVID = $_POST['GV_select'];
                                $Semester = $_POST['Semester_select'];
                                $Year = $_POST['Year_select'];
                                header("Location: http://localhost:8888/TeacherManagement/Admin/TeacherSchedule/ViewSchedule.php?teacherid=". $GVID ."&semester=".$Semester."&year=". $Year);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
