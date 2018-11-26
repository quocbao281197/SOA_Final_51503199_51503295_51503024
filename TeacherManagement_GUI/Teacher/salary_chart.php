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
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/getYear/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    //$data = array('username'=>$_SESSION['username']);
    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Year = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $test = (array)json_decode($array_Year,true);
?>


        <div class="content">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    </div>
                    <div class="col-md-2" style="font-size:1.5em;margin-top: 15px;">
                        Enter Year:
                    </div>
                    <div class="col-md-8">
                    <!-- <div class="custom-select" style="width:500px;"> -->
                        <form method = "post"> 
                            <select name = "Year_select" style="width: 250px;height:25px;text-align: center;background-color: #F2F2F2;border: 1px solid #E4E4E4;font-family: Arial;font-size:1.2em;margin-top: 20px;">
                                <?php
                                    foreach($test as $i){
                                        ?>
                                            <option value="<?= $i?>"> <?= $i?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <button type="submit">Submit</button>
                        </form>
                        <?php
                            if(isset($_POST['Year_select'])){

                                // $ch = curl_init();
                                // curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/filterMonthYear/");
                                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                // curl_setopt($ch, CURLOPT_POST, 1);
                                // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                            
                                // $data = array('id'=>$_SESSION['username'], 'Year' => $_POST['Year_select']);
                                // //$data = array();
                                // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                            
                                // $array_Salary1 = curl_exec($ch);
                                // $info = curl_getinfo($ch);
                                // curl_close($ch);
                                // //echo $array_Announcement;
                                // $salary = (array)json_decode($array_Salary1,true);
                                header("Location: View_salary_chart.php?year=".$_POST['Year_select']);

                            }
                            

                        ?>
                    </div>
                </div>

                <div id="chart_div"></div>

            
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="user.php">
                                User Profile
                            </a>
                        </li>
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

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>



    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</html>
