<?php
    $servername = "mysql-vsebastian.alwaysdata.net";
    $username = "336088";
    $password = "DawBD08*";
    $dbname = "vsebastian_dt";

    $link = new mysqli($servername, $username, $password, $dbname);
    
    if ($link->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>