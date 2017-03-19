<?php
require("database_conc.inc");

$sql_tub = "SELECT tub_raw.timestamp FROM tub_raw WHERE tub_raw.timestamp > (NOW() - INTERVAL 5 SECOND) LIMIT 1";
$sql_plug = "SELECT plug_raw.timestamp FROM plug_raw WHERE plug_raw.timestamp > (NOW() - INTERVAL 5 SECOND) LIMIT 1";

$result_tub = mysqli_query($link, $sql_tub) or die("Error in Selecting " . mysqli_error($link));
$result_plug = mysqli_query($link, $sql_plug) or die("Error in Selecting " . mysqli_error($link));

//$tempData = array();

if (mysql_num_rows($result_tub)>0){
	$tub = True;
}else{
	//$tub = False;
	$tub = mysql_num_rows($result_tub);
}

if (mysql_num_rows($result_plug)>0){
	$plug = True;
}else{
	$plug = False;
}

$tempData = ['tub' => $tub, 'plug' => $plug];

echo json_encode($tempData);

mysqli_close($link);

?>
