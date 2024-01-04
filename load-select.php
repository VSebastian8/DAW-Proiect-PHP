<?php
    $tabel = $_POST['table_name'];
    $action = $_POST['action'];

    require 'conexiune.php';
    
    $query="SELECT * FROM ".$tabel;
    $tabel_data = $link->query($query);

    $coloane_select = array("USERS" => ["id", "nume", "prenume"], "CONCURSURI" => ["id", "nume", "sport"], "SPORTIVI" => ["id", "nume", "prenume"], "A_PARTICIPAT" => ["id_sportiv", "id_concurs"], "NOTIFICARI" => ["id_user", "id_concurs"]);

    $coloane_tabel = array("USERS" => ["id" => "number", "nume" => "text", "prenume" => "text", "email" => "text", "parola" => "text"], "CONCURSURI" => ["id" => "number", "nume" => "text", "sport" => "text", "data" => "date"], "SPORTIVI" => ["id" => "number", "nume" => "text", "prenume" => "text", "tara" => "text", "data_nasterii" => "date"], "A_PARTICIPAT" => ["id_sportiv" => "number", "id_concurs" => "number", "loc" => "number", "premiu" => "text"], "NOTIFICARI" => ["id_user" => "number", "id_concurs" => "number"]);
    
    $coloane_required = array("USERS" => ["id" => False, "nume" => True, "prenume" => False, "email" => True, "parola" => True], "CONCURSURI" => ["id" => False, "nume" => False, "sport" => True, "data" => False], "SPORTIVI" => ["id" => False, "nume" => True, "prenume" => True, "tara" => True, "data_nasterii" => True], "A_PARTICIPAT" => ["id_sportiv" => True, "id_concurs" => True, "loc" => True, "premiu" => False], "NOTIFICARI" => ["id_user" => True, "id_concurs" => True]);

    echo '<input type = "hidden" name = "tabel" value = "'.$tabel.'">';
    if($action == 'DELETE' || $action == 'MODIFY'){
        echo '<select name = "target">';
        foreach($tabel_data as $row){
            echo '<option>';
            foreach($coloane_select[$tabel] as $col)
                echo $row[$col].' ';
            echo '</option>';
        }
        echo '</select>';
    }
    if($action == 'MODIFY' || $action == 'INSERT'){
        foreach($coloane_tabel[$tabel] as $col => $type){
                echo '<input type = "'.$type.'" name = "'.$col.'" placeholder = "'.$col.'"';
                if($coloane_required[$tabel][$col] && $action == 'INSERT')
                    echo 'required';
                echo '>';
        }
    }
    echo '<input type = "submit" name = "action" value = "'.$action.'"/>';

    mysqli_close($link);
    exit();
?>