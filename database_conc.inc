<?php
$link = mysqli_connect("ctv.mattburnett.co.uk", "bunit17", "Datthew1", "ctv_freshers");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>