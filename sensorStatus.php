<?php
require("database_conc.inc");

$sql_tub = "SELECT tub_raw.timestamp FROM tub_raw WHERE tub_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 1";
$sql_plug = "SELECT plug_raw.timestamp FROM plug_raw WHERE plug_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 0";

//$result_tub = mysqli_query($link, $sql_tub) or die("Error in Selecting " . mysqli_error($link));
//$result_plug = mysqli_query($link, $sql_plug) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();

if ($result_tub){
	$tempData["Tub"] = True
}else{
	$tempData["Tub"] = False
}

if ($result_plug){
	$tempData["Plug"] = True
}else{
	$tempData["Plug"] = False
}

echo json_encode($tempData);

mysqli_close($link);

?>
