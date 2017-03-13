<?php
require("database_conc.inc");

if (!($stmt = $link->prepare("SELECT plug_raw.decibel FROM plug_raw ORDER BY plug_raw.id DESC LIMIT 1"))){
		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
	}
if (!$stmt->execute()){
	header('HTTP/1.1 500 database execute error: '.$stmt->errno, TRUE, 500);
}
$stmt->bind_result($plug);
	while ($stmt->fetch()) {
		$json['plug'] = $plug;
	}

if (!($stmt = $link->prepare("SELECT tub_raw.decibel FROM tub_raw ORDER BY tub_raw.id DESC LIMIT 1"))){
		header('HTTP/1.1 500 database prepare error: '.$mysqli->errno, TRUE, 500);
	}
if (!$stmt->execute()){
	header('HTTP/1.1 500 database execute error: '.$stmt->errno, TRUE, 500);
}
$stmt->bind_result($tub);
	while ($stmt->fetch()) {
		$json['tub'] = $tub;
	}

echo json_encode($json);

mysqli_close($link);


?>
