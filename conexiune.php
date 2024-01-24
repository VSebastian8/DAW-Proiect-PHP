<?php
    require_once '.gitignore/secret_conexiune.php';
    $link = new mysqli($servername, $username, $password, $dbname);
    
    if ($link->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>