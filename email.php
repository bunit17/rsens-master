<?php
if(!$_GET['date']){
$date = "2015-10-21";
}else{
$date = $_GET['date'];
}
$start_date = date('Y-m-d H:i:s', strtotime($date));
$end_date = date('Y-m-d H:i:s', strtotime($date . "+28 hours"));
?>
<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
 <script src="scripts/date.js"></script>
 <script src="scripts/jquery.datepicker.js"></script>
 <link rel="stylesheet" type="text/css" href="css/tables-min.css">
 <link rel="stylesheet" type="text/css" href="css/datepicker.css">
<style>
DIV{-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-sizing:border-box;}

.left {
	padding: 10px;
    float: left;
    width: 70%;
    border: 5px;
    border-style: solid;
    border-color: black;
    background-color: #007FDF;
}
.right {
	padding: 10px;
    float: right;
    width: 30%;
    border: 5px;
    border-style: solid;
    border-color: black;
    background-color: #007FDF;
}
body {
	background-color: #000000;
	color: #FFFFFF;
	font-family: Tahoma;
}
.table{
	color: #000000;
	width:	100%;
}
.link {
	font-size: 30px;
    font-weight: bold;
    color: white;
    
    text-decoration: none;
}
</style>
</head>
<body>
<div class="left">

  <?php
require("database_conc.inc");
$stmt = $link->prepare("SELECT id, CONVERT_TZ(timestamp,  'America/Los_Angeles',  'Europe/London' ) AS timestamp, plug_adverage, 
tub_adverage, plug_peak, tub_peak FROM adverage_data WHERE timestamp > CONVERT_TZ( ?,  'Europe/London', 'America/Los_Angeles' )
 and timestamp < CONVERT_TZ( ?,  'Europe/London', 'America/Los_Angeles')");
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all
$data = $result->fetch_all();
$plug_output = array();
$row_count = count($data);
$i=0;
while($i<$row_count){
	if($data[$i][2]>100){
		$j=$i;
		while($j<$row_count && ($data[$j][2]>100 OR ($data[$j+1][2]>100 AND $data[$j][2]>90))){
						$plug_count[] = $data[$j][2];
						$j++;
		}
		
		$plug_average_of_count = round(array_sum($plug_count) / count($plug_count), 2);
		echo "<br>start time = ".$data[$i][1]." end time = ".$data[$j-1][1]." and adverage ".$plug_average_of_count;
		$i=$j-1;
		unset($count);
	}
	
	$i++;	
	
}
echo "<br><br> Tub <br>";
$i=0;
while($i<$row_count){
	if($data[$i][3]>100){
		$j=$i;
		while($j<$row_count && ($data[$j][3]>100 OR ($data[$j+1][3]>100 AND $data[$j][3]>90))){
						$tub_count[] = $data[$j][3];
						$j++;
		}
		
		$tub_average_of_count = round(array_sum($tub_count) / count($tub_count), 2);
		echo "<br>start time = ".$data[$i][1]." end time = ".$data[$j-1][1]." and adverage ".$tub_average_of_count;
		$i=$j-1;
		unset($count);
	}
	
	$i++;	
	
}
	


?>

</div>

</body>
</html>

