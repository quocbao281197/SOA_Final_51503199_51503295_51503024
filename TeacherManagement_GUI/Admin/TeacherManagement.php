<?php
    require_once('headers/TeacherManagementHeader.php');
?>
<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8888/TeacherManagement/login.php");
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
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="http://localhost:8888/TeacherManagement/Admin/Add_New_Teacher.php" style="color:white;">Add</a></button>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        
                                        <!-- <div class="rs-select6--dark rs-select6--sm rs-select6--dark2">
                                                <div class="row form-group">
                                                    <div class="col col-md-4" style="border-style: groove;">
                                                        <label for="file-input" class=" form-control-label" ><p style="margin-top: 5px;margin-left: 15px;color:red">Import CSV:<p></label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input type="file" id="file-input" name="file-input" class="form-control-file" value="Import CSV">
                                                </div>
                                            </div>
                                        </div> -->
                                        <form name="uploadfile" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                            <input type="file" type="file" name="file" id="file"></input>

                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small" name = "submitbtn">Submit</button>
                                        </form>
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
                                            curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/GetListTeacher/");
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
                                                                    <a href="http://localhost:8888/TeacherManagement/Admin/Edit_Teacher.php?id=<?=$t['id']?>" class="zmdi zmdi-edit"></a>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <a href="http://localhost:8888/TeacherManagement/Admin/Delete_Teacher.php?id=<?=$t['id']?>" class="zmdi zmdi-delete"></a>
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
                                    <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                        <strong> Import Success!</strong>
                                    </div>
                                    <div id="alert-addFail" class="alert alert-danger" style="display: none ;text-allign:center" >
                                        <strong> Import Failed!</strong>
                                    </div>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>

                    <?php
                        if ( isset($_POST["submitbtn"]) ) {
                            if ( isset($_FILES["file"])) {
                                    //if there was an error uploading the file
                                if ($_FILES["file"]["error"] > 0) {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                }
                                else {                                    
                                    //if file already exists
                                    if (file_exists("upload/" . $_FILES["file"]["name"])) {
                                            echo $_FILES["file"]["name"] . " already exists. ";
                                    }
                                    else {
                                            //Store file in directory "upload" with the name of "uploaded_file.txt"
                                            $storagename = "uploaded_file.txt";
                                            $destination = $_SERVER['DOCUMENT_ROOT'].'/TeacherManagement/fileUpload/'.$storagename;
                                            move_uploaded_file($_FILES["file"]["tmp_name"], $destination);

                                            $isEcho = 'true';
                                            // get content of file
                                            if ( $file = fopen( $destination , 'r' ) ) {
                                                $firstline = fgets ($file, 4096 );
                                                
                                                //Header at the first row of the csv file => $num
                                                $num = strlen($firstline) - strlen(str_replace(";", "", $firstline));

                                                //save the different fields of the firstline in an array called fields
                                                $fields = array();
                                                $fields = explode( ";", $firstline, ($num+1) );
                                            
                                                $line = array();
                                                $i = 0;

                                                $allData = "";
                                                //CSV: one line is one record and the cells/fields are seperated by ";"
                                                //so $dsatz is an two dimensional array saving the records like this: $dsatz[number of record][number of cell]
                                                while ( $line[$i] = fgets ($file, 4096) ) {
                                                    $data[$i] = array();
                                                    $data[$i] = explode( ",", $line[$i]);
                                                    //$dataconv = iconv('windows-1250', 'utf-8', file_get_contents($data[$i])); 
                                                    
                                                    $arr = $data[$i];
                                                    $allData = $allData . " " . $line[$i] . "\n";
   
                                                    $i++;
                                                }

                                                $ch = curl_init();
                                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/ImportCSV/");
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                curl_setopt($ch, CURLOPT_POST, 1);
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                                
                                                //$data = array('TEACHERNAME' => $username_input, 'DOB' => $DOB_input, 'IDENTIFYCARDNUMBER'=>$Identify_Card_Number_input, 'GENDER' => $gender_selected, 'PHONENUMBER' => $phone_input, 'COUNTRY' =>$Country_input, 'EMAIL' =>$email_input, 'ADDRESS' =>$Address_input, 'RELIGION' => $Religion_input, 'STATUS' =>$status_input, 'SUBJECT_NAME' =>$subject_input);
                                                // $data = array('TEACHERNAME' => iconv('windows-1250', 'utf-8', $arr[0]), 'DOB' => iconv('windows-1250', 'utf-8', $arr[1]), 'IDENTIFYCARDNUMBER'=>iconv('windows-1250', 'utf-8', $arr[2]), 'GENDER' => iconv('windows-1250', 'utf-8', $arr[3]), 
                                                // 'PHONENUMBER' => iconv('windows-1250', 'utf-8', $arr[4]), 'COUNTRY' => iconv('windows-1250', 'utf-8', $arr[5]), 'EMAIL' => iconv('windows-1250', 'utf-8', $arr[6]), 'ADDRESS' => iconv('windows-1250', 'utf-8', $arr[7])
                                                // , 'RELIGION' =>  iconv('windows-1250', 'utf-8', $arr[8]), 'SUBJECT_NAME' => iconv('windows-1250', 'utf-8', $arr[9]));
                                                //print_r($allData);
                                                $data = array('array' => $allData);
                                                
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                                $output = curl_exec($ch);
                                                $info = curl_getinfo($ch);
                                                curl_close($ch);
                                                if($output == "false"){
                                                    $isEcho = "false";
                                                    ?>
                                                        <script>
                                                            document.getElementById('alert-addFail').style.display = 'block';
                                                        </script>
                                                    <?php
                                                        echo("<meta http-equiv='refresh' content='5'>");
                                                }
                                            }
                                            //print_r($allData);
                                            if($isEcho == "true"){
                                                ?>
                                                    <script>
                                                        document.getElementById('alert-addSuccess').style.display = 'block';
                                                    </script>
                                                <?php
                                                    echo("<meta http-equiv='refresh' content='3'>");
                                            }
                                    }
                                }
                            } else {
                                    echo "No file selected <br />";
                            }
                        }
                    ?>
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
