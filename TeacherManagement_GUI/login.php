<!DOCTYPE html>
<html lang="en">
<head>
	<title>Teacher Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="login_Style/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/css/util.css">
	<link rel="stylesheet" type="text/css" href="login_Style/css/main.css">
	<!--===============================================================================================-->
</head>
<body>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100 p-t-50 p-b-90">
			<form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-51">
						Login
					</span>
				<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
					<input class="input100" type="text" name="username" placeholder="Username">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
				</div>

				<div class="flex-sb-m w-full p-t-3 p-b-24">
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div>
						<a href="#" class="txt1">
							Forgot?
						</a>
					</div>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						Login
					</button>
				</div>
			</form>
			<div id="alert" class="alert alert-danger" style="display: none ; float: center; text-allign:center" >
				<strong> Wrong username or password!!!! Please retype information</strong>
			</div>
		</div>
		<?php
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			// Send username/password to Tomcat server for authenticating
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/login/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

			$data = array('username'=>$_POST['username'],'password'=>$_POST['password']);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);

			//If the server returns TRUE, then print something
			if($output == "1")
			{
 				// $ch = curl_init();
				// curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/logging/");
				// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// curl_setopt($ch, CURLOPT_POST, 1);
				// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

				// $data = array('username'=>$_POST['username']);
				// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

				// $output1 = curl_exec($ch);
				// $info = curl_getinfo($ch);
				// curl_close($ch);
				// echo $output1; 
/* 				session_start();
				$_SESSION["username"]          = $_POST['username']; 
				header("Location: Teacher/admin.php"); */
				session_start();
				$_SESSION["username"]          = $_POST['username']; 
				header("Location: Admin/Admin_Account.php");
			}
			else if($output == "0")
			{
/* 				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/TeacherManagement/rest/Teacher/logging/");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

				$data = array('username'=>$_POST['username']);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

				$output1 = curl_exec($ch);
				$info = curl_getinfo($ch);
				curl_close($ch);
				echo $output1; */
				session_start();
				$_SESSION["username"]          = $_POST['username']; 
				header("Location: Teacher/user.php");
				//header("Location: teacher.html");
			}
			else if($output == "3"){
				header("Location: login.php");
			}
		}
		?>
	</div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="login_Style/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/bootstrap/js/popper.js"></script>
<script src="login_Style/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/daterangepicker/moment.min.js"></script>
<script src="login_Style/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="login_Style/js/main.js"></script>

</body>
</html>