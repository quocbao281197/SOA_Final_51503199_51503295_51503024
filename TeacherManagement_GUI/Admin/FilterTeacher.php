<?php
    require_once('headers/TeacherManagementHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
    if(isset($_GET["Status"])){
        $Status       = $_GET["Status"];
    }
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Teachers Information:</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="Properties_Sorted">
                                                <option selected="selected">All Properties</option>
                                                <option value="Actived">Actived</option>
                                                <option value="DeActived">DeActived</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="Add_New_Teacher.php">Add</a></button>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>SUBJECT</th>
                                                <th>STATUS</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <?php
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/TeacherManagement/GetListTeacher/");
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                        
                                            //$data = array('username'=>$_SESSION['username']);
                                            $data = array();
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                        
                                            $array_Teacher = curl_exec($ch);
                                            $info = curl_getinfo($ch);
                                            curl_close($ch);
                                            $teacher = (array)json_decode($array_Teacher,true);
                                        ?>

                                        <?php
                                            foreach($teacher as $t){
                                                ?>
                                                <tbody>
                                                    <tr class="tr-shadow">
                                                        <td>
                                                            <span><?= $t['id']?></span>
                                                        </td>
                                                        <td>
                                                            <span><?= $t['name']?></span>
                                                        </td>
                                                        <td><?= $t['email']?></td>
                                                        <td>
                                                            <span class="block-email"><?= $t['subjectname']?></span>
                                                        </td>
                                                        <td>
                                                            <span class="status--process"><?php 
                                                            if($t['status'] == "1"){
                                                                echo 'Active';
                                                            }
                                                            else{
                                                                echo 'Deactive';
                                                            }
                                                            ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature" style="float:left">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <a href="Edit_Teacher.php?id=<?=$t['id']?>" class="zmdi zmdi-edit"></a>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <a href="Delete_Teacher.php/?id=<?=$t['id']?>" class="zmdi zmdi-delete"></a>
                                                                </button>
                                                            </div>
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
