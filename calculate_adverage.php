<?php
require("database_conc.inc");
$stmt = $link->prepare("INSERT INTO adverage_data (plug_adverage, plug_peak, plug_sd, tub_adverage, tub_peak, tub_sd) 
SELECT * FROM (SELECT AVG(plug_raw.decibel) AS plug_adverage, MAX(plug_raw.decibel) AS plug_peak, STD(plug_raw.decibel) AS plug_sd, AVG(tub_raw.decibel) AS tub_adverage, MAX(tub_raw.decibel) AS tub_peak, STD(tub_raw.decibel) AS tub_sd from plug_raw, tub_raw) AS tmp 
WHERE EXISTS (SELECT id FROM tub_raw) AND EXISTS (SELECT id FROM plug_raw)");
$stmt->execute();

echo "".$stmt->affected_rows." rows inserted";
$stmt2 = $link->prepare("truncate tub_raw");
$stmt2->execute();
$stmt3 = $link->prepare("truncate plug_raw");
$stmt3->execute();

mysqli_close($link);
 

?>