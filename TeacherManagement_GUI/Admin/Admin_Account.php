<?php
    //require_once('headers/MyAccountHeader.php');
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin Information</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<script type="text/javascript">

        $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 5000);

        });
    </script>
</head>
<?php
    ob_start();
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
    $username = $_SESSION["username"];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/TeacherManagement/ViewAdminInfomation/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array('username'=>$_SESSION['username']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
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
    $status                         = $result['status'];
    //$subjectname                    = $result['subjectname'];

    $_SESSION['adminname']          = $name;
    $_SESSION['adminemail']         = $email;

    $adminname = $_SESSION['adminname'];
    $adminemail = $_SESSION['adminemail'] ;
?>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active">
                            <a href="Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li>
                            <a href="TeacherManagement.php">
                                <i class="fas fa-users"></i>TeacherManagement</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li>
                            <a href="TeacherManagement.php">
                                <i class="fas fa-users"></i>TeacherManagement</a>
                        </li>
						<li>
							<a href="Salary.php">
                                <i class="fas fa-users"></i>Salary</a>
						</li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu" style="float:right">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $username?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $adminname?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $adminemail?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="Admin_Account.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="AdminLogout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>My Information:</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="ID-input" class=" form-control-label">ID</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="ID_INPUT" name="ID_INPUT" placeholder="ID" disabled="" class="form-control" value="<?php echo $_SESSION["username"]?>">
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
                                                        <option value="0">Please select</option>
                                                        <option value="1" <?php if($status == '1'){ echo 'selected ="selected"';} ?>>Active</option>
                                                        <option value="0" <?php if($status == '0'){ echo 'selected ="selected"';} ?>>Deactive</option>
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
                                            <!-- <div class="row form-group">
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
                                            </div> -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Update
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm" onclick="<?php echo("<meta http-equiv='refresh' content='3'>");?>">
                                                    Reset
                                                </button>
                                            </div>
                                            <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                                <strong> Update Private Information Success!</strong>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['NAME_INPUT']) && isset($_POST['status_select']) && isset($_POST['DOB_INPUT']) && isset($_POST['IDENTIFY_CARD_NUMBER_INPUT']) && isset($_POST['COUNTRY_INPUT']) && isset($_POST['gender_select']) && isset($_POST['PHONE_NUMBER_INPUT']) && isset($_POST['EMAIL_INPUT']) && isset($_POST['ADDRESS_INPUT']) && isset($_POST['RELIGION_INPUT'])){
                                
                                $username_input              = $_POST['NAME_INPUT'];
                                $status_input                = $_POST['status_select'];
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
                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/TeacherManagement/UpdateAdmin/");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                                    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                               ));
                                //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                $data = array('ID'=>$_SESSION["username"], 'TEACHERNAME' => $username_input, 'DOB' => $DOB_input, 'IDENTIFYCARDNUMBER'=>$Identify_Card_Number_input, 'GENDER' => $gender_selected, 'PHONENUMBER' => $phone_input, 'COUNTRY' =>$Country_input, 'EMAIL' =>$email_input, 'ADDRESS' =>$Address_input, 'RELIGION' => $Religion_input, 'STATUS' =>$status_input);
                                //$data = array();
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                $output = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                curl_close($ch);
                                if($output == "true"){
                                    ?>
                                        <script>
                                            document.getElementById('alert-addSuccess').style.display = 'block';
                                        </script>
                                    <?php
                                    echo("<meta http-equiv='refresh' content='3'>");
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