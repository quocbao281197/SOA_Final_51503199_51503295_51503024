<head>
<title>My Account</title>
</head>
<?php
    require_once('headers/header.php');
?>
<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/ViewTeacherInfomation/");
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
    $subjectname                    = $result['subjectname'];
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>ID (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Teacher ID" value="<?php echo $username?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="text" class="form-control" name = "EMAIL_INPUT" placeholder="quocbao281197@gmail.com" value="<?php echo $email?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="NAME_INPUT" placeholder="Nguyễn Quốc Bảo" value="<?php echo $name?>">
                                            </div>
                                        </div>

										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <input type="date" class="form-control" name="DOB_INPUT" placeholder="dd/mm/yyyy" value="<?php echo substr($DOB, 0, 10)?>">
                                            </div>
                                        </div>
                                    </div>

									<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Identify Card Number</label>
                                                <input type="text" class="form-control" readonly name = "IDENTIFY_CARD_NUMBER_INPUT" placeholder="xxxxxxxxxx" value="<?php echo $identifycardnumber?>">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" class="form-control" name="GENDER_INPUT"  placeholder="Nam hoặc nữ" value="<?php echo $gender?>">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name = "PHONE_NUMBER_INPUT" placeholder="xxxxxxxxxx" value="<?php echo $phonenumber?>">
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name = "ADDRESS_INPUT" placeholder="Home Address" value="<?php echo $address?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input type="text" class="form-control" name = "RELIGION_INPUT" placeholder="Religion" value="<?php echo $religion?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name = "COUNTRY_INPUT" placeholder="Country" value="<?= $country?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subject Name:</label>
                                                <input type="text" class="form-control" name = "SUBJECT_INPUT" placeholder="Subject ID" value="<?= $subjectname?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>PASSWORD</label>
                                                <input type="text" class="form-control" name = "PASSWORD_INPUT" placeholder="Home Address" value="<?php echo $_SESSION["password"]?>">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                                <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                    <strong>Update Private Information Success!</strong>
                                </div>
                            </div>
                            <?php
                                if(isset($_POST['NAME_INPUT'])  && isset($_POST['DOB_INPUT']) 
                                                                && isset($_POST['IDENTIFY_CARD_NUMBER_INPUT']) 
                                                                && isset($_POST['COUNTRY_INPUT']) 
                                                                && isset($_POST['GENDER_INPUT']) 
                                                                && isset($_POST['PHONE_NUMBER_INPUT']) 
                                                                && isset($_POST['EMAIL_INPUT']) 
                                                                && isset($_POST['ADDRESS_INPUT']) 
                                                                && isset($_POST['RELIGION_INPUT'])
                                                                && isset($_POST['SUBJECT_INPUT'])
                                                                && isset($_POST['PASSWORD_INPUT'])){
                                    $ch = curl_init();
                                    curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
                                    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/UpdatePersonalInfomation/");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                                        'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                                    ));
                                    $data = array('ID'=>$_SESSION['username'], 'TEACHERNAME' =>$_POST['NAME_INPUT']
                                                    , 'DOB' => $_POST['DOB_INPUT']
                                                    , 'GENDER'=> $_POST['GENDER_INPUT']
                                                    , 'PHONENUMBER' => $_POST['PHONE_NUMBER_INPUT']
                                                    , 'COUNTRY' => $_POST['COUNTRY_INPUT']
                                                    , 'EMAIL' => $_POST['EMAIL_INPUT']
                                                    , 'ADDRESS' => $_POST['ADDRESS_INPUT']
                                                    , 'RELIGION' => $_POST['RELIGION_INPUT']
                                                    , 'PASSWORD' => $_POST['PASSWORD_INPUT']);
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
                                            unset($_SESSION["password"]);
                                            $_SESSION["password"] = $_POST['PASSWORD_INPUT'];
                                            echo("<meta http-equiv='refresh' content='3'>");
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="schedule.php">
                                Teaching Schedule
                            </a>
                        </li>
                        <li>
                            <a href="salary.php">
                                Personal Salary
                            </a>
                        </li>
						
						<li>
                            <a href="salary_chart.php">
                                Salary Chart
                            </a>
                        </li>
                        <li>
                            <a href="announcement.php">
                               Announcement
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>
<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Teacher Management System."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>
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
