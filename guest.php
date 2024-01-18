<?php
    require 'conexiune.php';

    $query_visit = $link->prepare("SELECT guests FROM VISITS WHERE ziua = CURDATE()");
    $query_visit->execute();
    $data3 = $query_visit->get_result();
    if($data3->num_rows == 0){
        $query_first_visit = $link->prepare("INSERT INTO VISITS VALUES (CURDATE(), 1, 0)");
        $query_first_visit->execute();
    }
    else{
        $row_visits = $data3->fetch_assoc();
        $guest_visits = $row_visits['guests'] + 1;
        $query_new_visit = $link->prepare("UPDATE VISITS SET guests = ? WHERE ziua = CURDATE()");
        $query_new_visit->bind_param("i", $guest_visits);
        $query_new_visit->execute();
    }

    mysqli_close($link);
    header('Location: index.php');

    exit;
?>