<?php
    require 'conexiune.php';
    echo '<br>';
    $sports = ['Fotbal', 'Volei', 'Tenis', 'Darts', 'Baschet'];
    foreach($sports as $sport){
        echo '<li class = "sport">'.$sport;
            echo '<ul class = "concursuri">';
            $query_concursuri = 'SELECT nume, data FROM CONCURSURI WHERE sport = "'.$sport.'";';
            $result = $link->query($query_concursuri);
            foreach($result as $row){
                echo '<li>'.$row['nume'].' | '.$sport.' | '.$row['data'].'</li>';
            }
            echo '</ul>';
        echo '</li>';
    }
    mysqli_close($link);
?>