<?php
require("database_conc.inc");

$sql_tub = "SELECT tub_raw.timestamp FROM tub_raw WHERE tub_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 1";
$sql_plug = "SELECT plug_raw.timestamp FROM plug_raw WHERE plug_raw.timestamp > (NOW() - INTERVAL 1 SECOND) LIMIT 1";

$result_tub = mysqli_query($link, $sql_tub) or die("Error in Selecting " . mysqli_error($link));
$result_plug = mysqli_query($link, $sql_plug) or die("Error in Selecting " . mysqli_error($link));

//$tempData = array();

if ($result_tub->num_rows>>0){
	$tub = True;
}else{
	//$tub = False;
	$tub = $result_tub->num_rows;
}

if ($result_plug->num_rows>>0){
	$plug = True;
}else{
	//$plug = False;
	$plug = $result_plug->num_rows;
}

$tempData = ['tub' => $tub, 'plug' => $plug];

echo json_encode($tempData);

mysqli_close($link);

?>
