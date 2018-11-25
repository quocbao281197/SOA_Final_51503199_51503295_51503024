<?php
    require_once('headers/ScheduleHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
?>

<?php
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
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Add Teacher Schedule:</strong>
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
                                                    <label for="select" class=" form-control-label">Day:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Day_select" id="Day" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Shift:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Shift_select" id="Shift" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Location_input" class=" form-control-label">Location Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="Location_input" name="Location_input" placeholder="Location" class="form-control">
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
                                                    <i class="fa fa-dot-circle-o"></i> Add
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-ban"></i> Reset
                                                </button>
                                            </div>
                                            <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                                <strong> Adding New Schedule Success!</strong>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php

                            if(isset($_POST['GV_select'])  && isset($_POST['Day_select']) && isset($_POST['Shift_select']) && isset($_POST['Location_input']) && isset($_POST['Semester_select']) && isset($_POST['Year_select'])){                            
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/TeacherManagement/AddSchedule/");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

                                $data = array('TeacherID'=>$_POST['GV_select'],'Day' => $_POST['Day_select'], 'Shift' =>$_POST['Shift_select'], 'Location' => $_POST['Location_input'], 'Semester'=>$_POST['Semester_select'], 'Year'=>$_POST['Year_select']);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                $output = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                curl_close($ch);
                                if($output == 'true'){
                                ?>
                                    <script>
                                        document.getElementById('alert-addSuccess').style.display = 'block';
                                    </script>
                                <?php
                                }
                                
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
