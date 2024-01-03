<?php
    $link = mysqli_connect("mysql-vsebastian.alwaysdata.net", "336088", "DawBD08*", "vsebastian_dt");
    if (!$link) {
        echo "Error: Unable to connect to MySQL.";
        exit;
    }
?>