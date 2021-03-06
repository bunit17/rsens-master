<?php
require("database_conc.inc");

$sql = "SELECT * FROM (SELECT MIN(CONVERT_TZ(timestamp,  'UTC',  'Europe/London' )) as timestamp, adverage_data.plug_peak, adverage_data.tub_peak, MIN(id) as id FROM adverage_data WHERE HOUR(timestamp) = 1 AND MINUTE(timestamp) = 00 GROUP BY DATE(timestamp), DAY(timestamp) ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC";

$result = mysqli_query($link, $sql) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();
while($row = mysqli_fetch_assoc($result))
{
	$tempData[] = $row;
}

echo json_encode($tempData);

mysqli_close($link);


?>
