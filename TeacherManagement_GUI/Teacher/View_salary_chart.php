<?php
    require_once('headers/header.php');
?>

<?php
    if(isset($_GET["year"])){
        $year       = $_GET["year"];
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/Teacher_Management_Final/rest/Teacher/Admin/filterMonthYear/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array('id'=>$_SESSION['username'], 'Year' => $year);
    //$data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Salary1 = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $salary_test = (array)json_decode($array_Salary1);
    $salary = (array)json_decode($array_Salary1,true);

?>

<head>
    <title>My Account</title>
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback();

        function load_monthwise_data(year, title)
        {
            var temp_title = title + ' '+year+'';
            data = year;
            drawMonthwiseChart(data, temp_title);

        }

        function drawMonthwiseChart(chart_data, chart_main_title)
        {
            var jsonData = chart_data;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('double', 'Total');
            
            $.each(jsonData, function(i, jsonData){
                var month = jsonData.month;
                var total = parseFloat($.trim(jsonData.total));
                data.addRows([[month, total]]);
            });
            var options = {
                title:chart_main_title,
                hAxis: {
                    title: "Months"
                },
                vAxis: {
                    title: 'Total'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
            chart.draw(data, options);
        }
    </script>
  
    <script>
        $(document).ready(function(){
            load_monthwise_data(, 'Month Wise Profit Data For');
        
        });
    </script> -->


        <script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Salary"
            },
            axisY: {
                title: "Total (VND)"
            },
            data: [{        
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "<?= $year?>",
                dataPoints: [      
                    <?php
                        foreach($salary as $s){
                            ?>
                                { y: <?=$s['total']?>, label: <?=$s['month']?> },
                            <?php
                        }    
                    ?>
                    // { y: 10000000, label: "Venezuela" },
                    // { y: 10000000,  label: "Saudi" },
                    // { y: 10000000,  label: "Canada" },
                    // { y: 10000000,  label: "Iran" },
                    // { y: 10000000,  label: "Iraq" },
                    // { y: 10000000, label: "Kuwait" },
                    // { y: 10000000,  label: "UAE" },
                    // { y: 13000000,  label: "Russia" },
                    // { y: 10000000,  label: "Russia" },
                    // { y: 12000000,  label: "Russia" },
                    // { y: 10000000,  label: "Russia" },
                    // { y: 8000000,  label: "Russia" }
                ]
            }]
        });
        chart.render();
    }
</script>
</head>
<?php
    if(!isset($_SESSION["username"])){
        header("Location: ../login.php");
    }
?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                    <!-- <div class="custom-select" style="width:500px;"> -->

                    </div>
                </div>

            
                </div>

                <div class = "row">
                    <div id="chartContainer" style="height: 510px; width: 100%;"></div>
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

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</html>
