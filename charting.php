<?php
require("database_conc.inc");

//if (!($stmt = $link->prepare("SELECT * FROM (SELECT  MIN(timestamp) as timestamp, adverage_data.plug_adverage, adverage_data.tub_adverage, MIN(id) as id FROM adverage_data WHERE HOUR(timestamp) = 4 AND MINUTE(timestamp) = 45 GROUP BY DATE(timestamp), DAY(timestamp) ORDER BY id DESC LIMIT 300) sub ORDER BY timestamp ASC"))){
//		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
if (!($stmt = $link->prepare("SELECT plug_raw.decibel FROM plug_raw ORDER BY plug_raw.id DESC LIMIT 10"))){
		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
	}
if (!$stmt->execute()){
	header('HTTP/1.1 500 database execute error: '.$stmt->errno, TRUE, 500);
}
$stmt->bind_result($avg);
	while ($stmt->fetch()) {
		$json['average'] = $avg;
	}

echo json_encode($json);

mysqli_close($link);


?>
