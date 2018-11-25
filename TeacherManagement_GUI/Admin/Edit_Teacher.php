<?php
    require_once('headers/TeacherManagementHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
    if(isset($_GET["id"])){
        $id       = $_GET["id"];
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/ViewTeacherInfomation/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    //$data = array('username'=>$_SESSION['username']);
    $data = array('username'=> $_GET["id"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    // if($output == 'true'){
    //     header("Location: http://localhost:8888/TeacherManagement/Admin/TeacherManagement.php");
    // }  
    $result = (array) json_decode($output);

    // User information
    $name                           = $result['name'];
    $DOB                            = $result['DOB'];
    $identifycardnumber             = $result['identifycardnumber'];
    $gender                         = $result['gender'];
    $phonenumber                    = $result['phonenumber'];
    $country                        = $result['country'];
    $email                          = $result['email'];
    $address                        = $result['address'];
    $religion                       = $result['religion'];
    $subjectname                    = $result['subjectname'];
    $status                         = $result['status'];

    $adminname                      = $_SESSION['adminname'];
    $adminemail                     = $_SESSION['adminemail'];
?>
            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Teacher Information:</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" accept-charset="UTF-8">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="ID-input" class=" form-control-label">ID</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="ID_INPUT" name="ID_INPUT" placeholder="ID" disabled="" class="form-control" value="<?php echo $id?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="NAME_INPUT" name="NAME_INPUT" placeholder="Nguyen Quoc Bao" class="form-control" value = "<?php echo $name?>">
                                                    <small class="form-text text-muted">Please enter username</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Status</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="status_select" id="status_select" class="form-control">
                                                        <option value="99">Please select</option>
                                                        <option value="1" <?php if($status == '1'){ echo 'selected ="selected"';} ?>>Active</option>
                                                        <option value="0" <?php if($status == '0'){ echo 'selected ="selected"';} ?>>Deactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Subject</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="subject_select" id="subject_select" class="form-control" value="<?php echo $set_value?>">
                                                        <option value="0">Please select</option>
                                                        <option value="Toán" <?php if($subjectname == 'Toán'){ echo 'selected ="selected"';} ?>>Toán</option>
                                                        <option value="Xác suất thống kê" <?php if($subjectname == 'Xác suất thống kê'){ echo 'selected="selected"';} ?>>Xác suất thống kê</option>
                                                        <option value="Ngữ Văn" <?php if($subjectname == 'Ngữ Văn'){ echo 'selected="selected"';} ?>>Ngữ Văn</option>
                                                        <option value="Vật lý" <?php if($subjectname == 'Vật lý'){ echo 'selected="selected"';} ?>>Vật lý</option>
                                                        <option value="Hóa học" <?php if($subjectname == 'Hóa học'){ echo 'selected="selected"';} ?>>Hóa học</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                
                                                <div class="col col-md-3">
                                                    <label for="DOB-input" class=" form-control-label">DOB</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="DOB_INPUT" name="DOB_INPUT" placeholder="yyyy/mm/dd" class="form-control" value="<?php echo substr($DOB, 0, 10);?>">
                                                    <small class="help-block form-text">Please enter your Date Of Birth</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Identify_Card_Number-input" class=" form-control-label">Identify Card Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="IDENTIFY_CARD_NUMBER_INPUT" name="IDENTIFY_CARD_NUMBER_INPUT" placeholder="Identify Card Number" class="form-control" value="<?php echo $identifycardnumber?>">
                                                    <small class="help-block form-text">Please enter your Identify Card Number</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Gender</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="gender_select" id="gender" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <option value="Nam" <?php if($gender == 'Nam'){ echo 'selected ="selected"';} ?>>Nam</option>
                                                        <option value="Nữ" <?php if($gender == 'Nữ'){ echo 'selected ="selected"';} ?>>Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Phone-input" class=" form-control-label">Phone Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="PHONE_NUMBER_INPUT" name="PHONE_NUMBER_INPUT" placeholder="Phone Number" class="form-control" value="<?php echo $phonenumber?>">
                                                    <small class="help-block form-text">Please enter your Phone Number</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Country-input" class=" form-control-label">Country</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="COUNTRY_INPUT" name="COUNTRY_INPUT" placeholder="Enter Country" class="form-control" value="<?php echo $country?>">
                                                    <small class="help-block form-text">Please enter your Country</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Email Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="EMAIL_INPUT" name="EMAIL_INPUT" placeholder="Enter Email" class="form-control" value="<?php echo $email?>">
                                                    <small class="help-block form-text">Please enter your email</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="password-input" name="password-input" placeholder="Password" class="form-control">
                                                    <small class="help-block form-text">Please enter a complex password</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Address-input" class=" form-control-label">Address Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="ADDRESS_INPUT" name="ADDRESS_INPUT" placeholder="Enter Address" class="form-control" value="<?php echo $address?>">
                                                    <small class="help-block form-text">Please enter your Address</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Religion-input" class=" form-control-label">Religion Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="RELIGION_INPUT" name="RELIGION_INPUT" placeholder="Enter Religion" class="form-control" value="<?php echo $religion?>">
                                                    <small class="help-block form-text">Please enter your Religion</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Textarea</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                                                </div>
                                            </div>
 
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">Teacher Image</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="file-input" class="form-control-file">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Update
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                            <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                                <strong> Update Teacher Information Success!</strong>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            
                            if(isset($_POST['NAME_INPUT']) && isset($_POST['status_select']) && isset($_POST['subject_select']) && isset($_POST['DOB_INPUT']) && isset($_POST['IDENTIFY_CARD_NUMBER_INPUT']) && isset($_POST['COUNTRY_INPUT']) && isset($_POST['gender_select']) && isset($_POST['PHONE_NUMBER_INPUT']) && isset($_POST['EMAIL_INPUT']) && isset($_POST['ADDRESS_INPUT']) && isset($_POST['RELIGION_INPUT'])){
                                
                                $username_input              = $_POST['NAME_INPUT'];
                                $status_input                = $_POST['status_select'];
                                $subject_input               = $_POST['subject_select'];
                                $DOB_input                   = $_POST['DOB_INPUT'];
                                $Identify_Card_Number_input  = $_POST['IDENTIFY_CARD_NUMBER_INPUT'];
                                $Country_input               = $_POST['COUNTRY_INPUT'];
                                $gender_selected             = $_POST['gender_select'];
                                $phone_input                 = $_POST['PHONE_NUMBER_INPUT'];
                                $email_input                 = $_POST['EMAIL_INPUT'];
                                $Address_input               = $_POST['ADDRESS_INPUT'];
                                $Religion_input              = $_POST['RELIGION_INPUT'];

                                //htmlentities($_POST['NAME_INPUT'], ENT_QUOTES, "UTF-8");

                                // $username_input              = mb_convert_encoding($_POST['NAME_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $status_input                = mb_convert_encoding($_POST['status_select'], "HTML-ENTITIES", "UTF-8");
                                // $subject_input               = mb_convert_encoding($_POST['subject_select'], "HTML-ENTITIES", "UTF-8");
                                // $DOB_input                   = mb_convert_encoding($_POST['DOB_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $Identify_Card_Number_input  = mb_convert_encoding($_POST['IDENTIFY_CARD_NUMBER_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $Country_input               = mb_convert_encoding($_POST['COUNTRY_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $gender_selected             = mb_convert_encoding($_POST['gender_select'], "HTML-ENTITIES", "UTF-8");
                                // $phone_input                 = mb_convert_encoding($_POST['PHONE_NUMBER_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $email_input                 = mb_convert_encoding($_POST['EMAIL_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $Address_input               = mb_convert_encoding($_POST['ADDRESS_INPUT'], "HTML-ENTITIES", "UTF-8");
                                // $Religion_input              = mb_convert_encoding($_POST['RELIGION_INPUT'], "HTML-ENTITIES", "UTF-8");
                                
                                // Update Information
                                $ch = curl_init();
                                curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/UpdateTeacherInfo/");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                                    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                               ));
                                //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                $data = array('ID'=>$_GET["id"], 'TEACHERNAME' => $username_input, 'DOB' => $DOB_input, 'IDENTIFYCARDNUMBER'=>$Identify_Card_Number_input, 'GENDER' => $gender_selected, 'PHONENUMBER' => $phone_input, 'COUNTRY' =>$Country_input, 'EMAIL' =>$email_input, 'ADDRESS' =>$Address_input, 'RELIGION' => $Religion_input, 'STATUS' =>$status_input, 'SUBJECT_NAME' =>$subject_input);
                                //$data = array();
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                $output = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                curl_close($ch);
                                if($output = "true"){
                                    ?>
                                        <script>
                                            document.getElementById('alert-addSuccess').style.display = 'block';
                                        </script>
                                    <?php
                                    echo("<meta http-equiv='refresh' content='5'>");
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
