<?php
//INSERT INTO adverage_data (plug_adverage, plug_peak, tub_adverage, tub_peak) 
//SELECT * FROM (SELECT AVG(plug_raw.decibel) AS plug_adverage, MAX(plug_raw.decibel) AS plug_peak, AVG(tub_raw.decibel) AS tub_adverage, MAX(tub_raw.decibel) AS tub_peak from plug_raw, tub_raw) AS tmp 
//WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)
require("database_conc.inc");
if (!($stmt = $link->prepare("SELECT *, ((tmp2.plug_adverage + tmp.live_plug_adverage)/2) as uptodate_plug_adverage, ((tmp2.tub_adverage + tmp.live_tub_adverage)/2) as uptodate_tub_adverage FROM (SELECT AVG(plug_raw.decibel) AS live_plug_adverage, AVG(tub_raw.decibel) AS live_tub_adverage from plug_raw, tub_raw) AS tmp, (SELECT plug_adverage, tub_adverage, (plug_adverage+plug_sd+plug_sd) as plug_peak, (tub_adverage+tub_sd+tub_sd) as tub_peak FROM adverage_data ORDER BY timestamp DESC LIMIT 1) as tmp2 WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)"))){
		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
	}
if (!$stmt->execute()){
	header('HTTP/1.1 500 database execute error: '.$stmt->errno, TRUE, 500);
}
$stmt->bind_result($live_plug_adverage, $live_tub_adverage, $plug_adverage, $tub_adverage, $plug_peak, $tub_peak, $uptodate_plug_adverage, $uptodate_tub_adverage);
	while ($stmt->fetch()) {
		$json['plug_adverage'] = $uptodate_plug_adverage;
		$json['plug_peak'] = $plug_peak;
		$json['tub_adverage'] = $uptodate_tub_adverage;
		$json['tub_peak'] = $tub_peak;
	}

echo json_encode($json);

mysqli_close($link);

?>