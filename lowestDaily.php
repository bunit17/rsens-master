<?php
require("database_conc.inc");

$sql1 = "SELECT * FROM (SELECT MIN(CONVERT_TZ(timestamp,  'UTC',  'Europe/London' )) as timestamp, MIN(plug_adverage) as plug_adverage FROM adverage_data GROUP BY DATE(timestamp), DAY(timestamp) ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC";
$result1 = mysqli_query($link, $sql1) or die("Error in Selecting " . mysqli_error($link));

$sql2 = "SELECT * FROM (SELECT MIN(CONVERT_TZ(timestamp,  'UTC',  'Europe/London' )) as timestamp, MIN(tub_adverage) as tub_adverage FROM adverage_data GROUP BY DATE(timestamp), DAY(timestamp) ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC";
$result2 = mysqli_query($link, $sql2) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();
$tempData1 = array();
$tempData2 = array();

while($row = mysqli_fetch_assoc($result1))
{
	$tempData1[] = $row;
}

while($row = mysqli_fetch_assoc($result2))
{
	$tempData2[] = $row;
}

$tempData = ['tub' => $tempData2, 'plug' => $tempData1];

echo json_encode($tempData);

mysqli_close($link);


?>
