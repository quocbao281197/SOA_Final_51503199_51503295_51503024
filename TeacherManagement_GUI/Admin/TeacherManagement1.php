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
    <title>Teachers Information</title>

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

</head>
<?php
    ob_start();
    session_start();
    $username = $_SESSION["username"];

    $adminname = $_SESSION['adminname'];
    $adminemail = $_SESSION['adminemail'];
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
                            <a href="http://localhost:8888/TeacherManagement/Admin/Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="http://localhost:8888/TeacherManagement/Admin/Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="http://localhost:8888/TeacherManagement/Admin/View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://localhost:8888/TeacherManagement/Admin/Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li>
                            <a href="http://localhost:8888/TeacherManagement/Admin/TeacherManagement.php">
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
                        <li>
                            <a href="http://localhost:8888/TeacherManagement/Admin/Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="http://localhost:8888/TeacherManagement/Admin/Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="http://localhost:8888/TeacherManagement/Admin/View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://localhost:8888/TeacherManagement/Admin/Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li class="active">
                            <a href="http://localhost:8888/TeacherManagement/Admin/TeacherManagement.php">
                                <i class="fas fa-users"></i>TeacherManagement</a>
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
                                                    <a href="http://localhost:8888/TeacherManagement/Admin/Admin_Account.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="http://localhost:8888/TeacherManagement/Admin/AdminLogout.php">
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
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Teachers Information:</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
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
                                            <i class="zmdi zmdi-plus"></i><a href="http://localhost:8888/TeacherManagement/Admin/Add_New_Teacher.php">Add</a></button>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
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
                                            curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/TeacherManagement/GetListTeacher/");
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
                                                            <label class="au-checkbox">
                                                                <input type="checkbox">
                                                                <span class="au-checkmark"></span>
                                                            </label>
                                                        </td>
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
                                                                    <a href="http://localhost:8888/TeacherManagement/Admin/Delete_Teacher.php/?id=<?=$t['id']?>" class="zmdi zmdi-delete"></a>
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
