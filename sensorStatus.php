<?php
require("database_conc.inc");

$sql_tub = "SELECT * FROM `tub_raw` ORDER BY `timestamp` DESC AND timestamp > (now() - INTERVAL 1 SECOND)";
$sql_plug = "SELECT * FROM `plug_raw` ORDER BY `timestamp` DESC AND timestamp > (now() - INTERVAL 1 SECOND)";

$result_tub = mysqli_query($link, $sql_tub) or die("Error in Selecting " . mysqli_error($link));
$result_plug = mysqli_query($link, $sql_plug) or die("Error in Selecting " . mysqli_error($link));

$tempData = array();
while($row =mysqli_fetch_assoc($result_tub))
{
	$tempData[] = $row;
}

echo json_encode($tempData);

mysqli_close($link);


?>
