<?php
    require_once('headers/ScheduleHeader.php');
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
                                                        <option value="GV001">GV001</option>
                                                        <option value="GV002">GV002</option>
                                                        <option value="GV003">GV003</option>
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
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    View
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm">
                                                    Reset
                                                </button >
                                                <button style="background-color: #4CAF50" class="btn btn-primary btn-sm">
                                                    <i class="zmdi zmdi-plus"></i><a href="Add_New_Schedule.php" style="color:white">Add</a>
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
                                header("Location: TeacherSchedule/ViewSchedule.php?teacherid=". $GVID ."&semester=".$Semester."&year=". $Year);
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
