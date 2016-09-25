<?php
require("database_conc.inc");

$stmt = $link->prepare("SELECT plug_raw.decibel FROM plug_raw ORDER BY plug_raw.id DESC LIMIT 1");
$stmt->execute();
$stmt->bind_result($plug);
	while ($stmt->fetch()) {
		$json['plug'] = $plug;
	}

$stmt = $link->prepare("SELECT tub_raw.decibel FROM tub_raw ORDER BY tub_raw.id DESC LIMIT 1");
$stmt->execute();
$stmt->bind_result($tub);
	while ($stmt->fetch()) {
		$json['tub'] = $tub;
	}


echo json_encode($json);

mysqli_close($link);

?>