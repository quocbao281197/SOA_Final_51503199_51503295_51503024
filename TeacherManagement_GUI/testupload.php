<!DOCTYPE html>
<html lang="vi">
<head>
	<!--===============================================================================================-->
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

<body>
	<form name="uploadfile" action="" method="post" enctype="multipart/form-data">
		<div class = "row">
			<div class = "col-lg-8">
				<input type="file" type="file" name="file" id="file"></input>
			</div>
			<div class= "col-lg-4">
				<button type="submit" name = "submitbtn">Submit</button>
			</div>
		</div>
	</form>

	<?php
		if ( isset($_POST["submitbtn"]) ) {
			if ( isset($_FILES["file"])) {
		 
					 //if there was an error uploading the file
				 if ($_FILES["file"]["error"] > 0) {
					 echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
				 }
				 else {
						  //Print file details
					  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
					  echo "Type: " . $_FILES["file"]["type"] . "<br />";
					  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
					  echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
					  
						  //if file already exists
					  if (file_exists("upload/" . $_FILES["file"]["name"])) {
					 		echo $_FILES["file"]["name"] . " already exists. ";
					  }
					  else {
							 //Store file in directory "upload" with the name of "uploaded_file.txt"
							$storagename = "uploaded_file.txt";
							$destination = $_SERVER['DOCUMENT_ROOT'].'/TeacherManagement/fileUpload/'.$storagename;
							move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
							//echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
							echo "Stored in: " . $destination;

							// get content of file
							if ( $file = fopen( $destination , 'r' ) ) {

								echo "File opened.<br />";

								$firstline = fgets ($file, 4096 );
								
								//Header at the first row of the csv file => $num
								$num = strlen($firstline) - strlen(str_replace(";", "", $firstline));
								echo "Num là: ". strlen(str_replace(";", "", $firstline));

								//save the different fields of the firstline in an array called fields
								$fields = array();
								$fields = explode( ";", $firstline, ($num+1) );
							
								$line = array();
								$i = 0;
								echo "<br>";
									//CSV: one line is one record and the cells/fields are seperated by ";"
									//so $dsatz is an two dimensional array saving the records like this: $dsatz[number of record][number of cell]
								while ( $line[$i] = fgets ($file, 4096) ) {
									echo "Line is: " . $line[$i] ."<br>";
									$data[$i] = array();
									$data[$i] = explode( ",", $line[$i]);
									echo "After convert: " . "<br>";
									print_r($data[$i]);
									$arr = $data[$i];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/ImportCSV/");
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
								
									//$data = array('TEACHERNAME' => $username_input, 'DOB' => $DOB_input, 'IDENTIFYCARDNUMBER'=>$Identify_Card_Number_input, 'GENDER' => $gender_selected, 'PHONENUMBER' => $phone_input, 'COUNTRY' =>$Country_input, 'EMAIL' =>$email_input, 'ADDRESS' =>$Address_input, 'RELIGION' => $Religion_input, 'STATUS' =>$status_input, 'SUBJECT_NAME' =>$subject_input);
									$data = array('TEACHERNAME' => $arr[0], 'DOB' => $arr[1], 'IDENTIFYCARDNUMBER'=>$arr[2], 'GENDER' => $arr[3], 
									'PHONENUMBER' => $arr[4], 'COUNTRY' => $arr[5], 'EMAIL' => $arr[6], 'ADDRESS' => $arr[7]
									, 'RELIGION' =>  $arr[8], 'SUBJECT_NAME' => $arr[9]);
	
									//$data = array();
									curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
									$output = curl_exec($ch);
									$info = curl_getinfo($ch);
									curl_close($ch);
								   // print_r($data);
									if($output == 'true'){
										echo "Added Success!";
									}
									$i++;
								}
							
								// print table
								// 	echo "<table>";
								// 	echo "<tr>";
								// for ( $k = 0; $k != ($num+1); $k++ ) {
								// 	echo "<td>" . $fields[$k] . "</td>";
								// }
								// 	echo "</tr>";
							
								// foreach ($dsatz as $key => $number) {
								// 			//new table row for every record
								// 	echo "<tr>";
								// 	foreach ($number as $k => $content) {
								// 					//new table cell for every field of the record
								// 		echo "<td>" . $content . "</td>";
								// 	}
								// }
							
								// echo "</table>";
							}
					 }
				 }
			  } else {
					  echo "No file selected <br />";
			  }
		 }
	?>



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