<?php
    if(!isset($_SESSION))
        require 'sesiune';
    if(!isset($_SESSION['username']) or $_SESSION['username'] == 'Guest')
        header('Location: login.php');
    require 'conexiune.php';

    $query_notificari = 'SELECT c.nume "concurs" FROM NOTIFICARI n JOIN CONCURSURI c ON (n.id_concurs = c.id) WHERE n.id_user = '.$_SESSION['userId'].';';

    $result = $link->query($query_notificari);
    $first = true;
    foreach($result as $row){
        if(!$first){
            echo '<hr>';
        }
        echo '<a>'.$row['concurs'].'</a>';
        $first = false;
    }


    mysqli_close($link);
?>