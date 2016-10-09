<?php
if(empty($_GET['date'])){
$date = date('d-m-Y');
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
	height: 100%;
    overflow-y: scroll;
	overflow-x: hidden;
	outline:none;
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
<div id="left" tabindex="-1" class="left">
<table class="pure-table pure-table-bordered table">
  <thead>
  <tr>
	<th>Time</th>
    <th>Plug Average</th>
	<th>Plug Peak (2&#x03c3)</th>
	<th>Tub Average</th>
	<th>Tub Peak (2&#x03c3)</th>
	</tr>
  </thead>
  <tbody>
  <?php
require("database_conc.inc");
$i=0;
$stmt = $link->prepare("SELECT id, CONVERT_TZ(timestamp,  'UTC',  'Europe/London' ) AS timestamp, plug_adverage, tub_adverage, (plug_adverage+plug_sd+plug_sd) as plug_peak, (tub_adverage+tub_sd+tub_sd) as tub_peak FROM adverage_data WHERE timestamp > CONVERT_TZ( ?,  'Europe/London', 'UTC' )
 and timestamp < CONVERT_TZ( ?,  'Europe/London', 'UTC')");
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$stmt->bind_result($id, $timestamp, $plug_adverage, $tub_adverage, $plug_peak, $tub_peak);
	while ($stmt->fetch()) {
		echo "<tr";
		if($i % 2 == 0){
			echo " class=\"pure-table-even\" ";
		}else{
			echo " class=\"pure-table-odd\" ";
		}
		echo ">";
		echo "<td>".$timestamp."</td>";
		echo "<td>".$plug_adverage."</td>";
		echo "<td>".$plug_peak."</td>";
		echo "<td>".$tub_adverage."</td>";
		echo "<td>".$tub_peak."</td>";
		echo "</tr>";
		$i++;
	}
	
mysqli_close($link);
?>
</tbody>
 </table>
</div>
<div class="right">
<h1>University of Bath Students' Union - Decibel Monitor</h1>
<p>
Please select the data of the day you would like to view the data for. 
</p>
<div id="datepicker"></div>

<h2><a href="index.php" class="link">Back to live view</a>
</div>

<script type="text/javascript" charset="utf-8">
	
	$( document ).ready(function() {
		Date.format = 'dd-mm-yyyy';
		$('#datepicker')
		.datePicker({
			inline:true,
			startDate: '10/10/2015',
			endDate: (new Date()).asString()
		}).dpSetSelected('<?php echo date('d-m-Y', strtotime($date)); ?>')
		.bind(
			'dateSelected',

			function(e, selectedDate, $td)
			{
				var d = selectedDate;

				if (d) {
				d = new Date(d);
				var start_date = d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2);
				window.location = "history.php?date="+start_date;
				}
				
			}
		);
		
		 document.getElementById('left').focus();
	});
</script>
 
</body>
</html>

