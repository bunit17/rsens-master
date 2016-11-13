<?php
//INSERT INTO adverage_data (plug_adverage, plug_peak, tub_adverage, tub_peak) 
//SELECT * FROM (SELECT AVG(plug_raw.decibel) AS plug_adverage, MAX(plug_raw.decibel) AS plug_peak, AVG(tub_raw.decibel) AS tub_adverage, MAX(tub_raw.decibel) AS tub_peak from plug_raw, tub_raw) AS tmp 
//WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)
require("database_conc.inc");
if (!($stmt = $link->prepare("SELECT * FROM (SELECT AVG(plug_raw.decibel) AS plug_adverage, MAX(plug_raw.decibel) AS plug_peak, STD(plug_raw.decibel) AS plug_sd, AVG(tub_raw.decibel) AS tub_adverage, MAX(tub_raw.decibel) AS tub_peak, STD(tub_raw.decibel) AS tub_sd from plug_raw, tub_raw WHERE plug_raw.timestamp > ADDDATE(NOW(), INTERVAL -5 MINUTE) AND tub_raw.timestamp > ADDDATE(NOW(), INTERVAL -5 MINUTE)) AS tmp WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)"))){
		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
	}
if (!$stmt->execute()){
	header('HTTP/1.1 500 database execute error: '.$stmt->errno, TRUE, 500);
}
$stmt->bind_result($plug_adverage, $plug_peak, $plug_sd, $tub_adverage, $tub_peak, $tub_sd);
	while ($stmt->fetch()) {
		$json['plug_adverage'] = $plug_adverage;
		$json['plug_peak'] = $plug_adverage+$plug_sd+$plug_sd;
		$json['tub_adverage'] = $tub_adverage;
		$json['tub_peak'] = $tub_adverage+$tub_sd+$tub_sd;
	}

echo json_encode($json);

mysqli_close($link);

?>