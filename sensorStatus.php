<?php
require("database_conc.inc");

$sql_tub = "SELECT tub_raw.timestamp FROM tub_raw WHERE tub_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 1";
$sql_plug = "SELECT plug_raw.timestamp FROM plug_raw WHERE plug_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 0";

$result_tub = mysqli_query($link, $sql_tub) or die("Error in Selecting " . mysqli_error($link));
$result_plug = mysqli_query($link, $sql_plug) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();

if ($result_tub){
	$tub = True
}else{
	$tub = False
}

if ($result_plug){
	$plug = True
}else{
	$plug = False
}

$tempData = ['tub' => $tub, 'plug' => $plug]

echo json_encode($tempData);

mysqli_close($link);

?>
