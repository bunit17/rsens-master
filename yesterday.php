<?php
require("database_conc.inc");

$sql = "SELECT * FROM (SELECT MIN(timestamp) as timestamp, adverage_data.plug_adverage, adverage_data.tub_adverage,adverage_data.plug_peak, adverage_data.tub_peak FROM adverage_data WHERE timestamp >= now() - INTERVAL 1 DAY ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC";

$result = mysqli_query($link, $sql) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();
while($row = mysqli_fetch_assoc($result))
{
	$tempData[] = $row;
}

echo json_encode($tempData);

mysqli_close($link);


?>
