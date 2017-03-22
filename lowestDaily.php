<?php
require("database_conc.inc");

$sql = "SELECT * FROM (SELECT MIN(timestamp) as timestamp, adverage_data.plug_adverage, MIN(plug_adverage) as plug_adverage FROM adverage_data GROUP BY DATE(timestamp), DAY(timestamp) ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC";

$result = mysqli_query($link, $sql) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();
while($row = mysqli_fetch_assoc($result))
{
	$tempData[] = $row;
}

echo json_encode($tempData);

mysqli_close($link);


?>
