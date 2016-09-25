<?php
//INSERT INTO adverage_data (plug_adverage, plug_peak, tub_adverage, tub_peak) 
//SELECT * FROM (SELECT AVG(plug_raw.decibel) AS plug_adverage, MAX(plug_raw.decibel) AS plug_peak, AVG(tub_raw.decibel) AS tub_adverage, MAX(tub_raw.decibel) AS tub_peak from plug_raw, tub_raw) AS tmp 
//WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)
require("database_conc.inc");
$stmt = $link->prepare("SELECT plug_adverage, tub_adverage, (plug_adverage+plug_sd+plug_sd) as plug_peak, (tub_adverage+tub_sd+tub_sd) as tub_peak FROM adverage_data ORDER BY timestamp DESC LIMIT 1");
$stmt->execute();
$stmt->bind_result($plug_adverage, $tub_adverage, $plug_peak, $tub_peak);
	while ($stmt->fetch()) {
		$json['plug_adverage'] = $plug_adverage;
		$json['plug_peak'] = $plug_peak;
		$json['tub_adverage'] = $tub_adverage;
		$json['tub_peak'] = $tub_peak;
	}

echo json_encode($json);

mysqli_close($link);

?>