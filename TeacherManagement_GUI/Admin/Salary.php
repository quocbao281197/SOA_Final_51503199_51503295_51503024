<?php
    require_once('headers/SalaryHeader.php');
?>

<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/Admin/getListSalary/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Salary = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $Salary = (array)json_decode($array_Salary,true);
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Salary Data:</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="Add_New_Salary.php">Add</a></button>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Teacher ID</th>
                                                <th>Month</th>
                                                <th>Year</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <?php
                                            foreach($Salary as $s){
                                                ?>
                                                <tbody>
                                                    <tr class="tr-shadow">
                                                        <td>
                                                            <span><?= $s['teacherID']?></span>
                                                        </td>
                                                        <td>
                                                            <span><?= $s['month']?></span>
                                                        </td>
                                                        <td><?= $s['year']?></td>
                                                        <td>
                                                            <span class="block-email"><?= $s['total']?></span>
                                                        </td>
                                                    </tr>
                                                    <tr class="spacer"></tr>
                                                </tbody>
                                                <?php
                                            }
                                        ?>

                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
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
