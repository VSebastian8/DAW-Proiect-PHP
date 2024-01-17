<?php
    require 'conexiune.php';
    echo '<br>';
    $sports = ['Fotbal', 'Volei', 'Tenis', 'Darts', 'Baschet'];
    foreach($sports as $sport){
        echo '<img class = "sport_icon" src = "assets/'.strtolower($sport).'.svg"></img>';
        echo '<li class = "sport">';
        echo $sport;
        echo '<ul class = "concursuri">';
            $query_concursuri = 'SELECT id, nume, data FROM CONCURSURI WHERE sport = "'.$sport.'";';
            $result = $link->query($query_concursuri);
            foreach($result as $row){
                echo '<li class = "concurs" data_id = "'.$row['id'].'">'.$row['nume'].' | '.$sport.' | '.$row['data'].'</li>';
            }
            echo '</ul>';
        echo '</li>';
    }
    mysqli_close($link);
?>