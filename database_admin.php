<?php
    if(!isset($_SESSION))
        require 'sesiune.php';

    if($_SESSION['rol'] != 'admin'){
        header("Location: index.php");
        exit();
    }

    if(!isset($_POST)){
        header("Location: index.php");
        exit();
    }  

    $act = $_POST['action'];
    $tabel = $_POST['tabel'];

    $coloane_tabel = array("USERS" => ["id" => "num", "nume" => "char", "prenume" => "char", "email" => "char", "parola" => "char"], "CONCURSURI" => ["id" => "num", "nume" => "char", "sport" => "char", "data" => "date"], "SPORTIVI" => ["id" => "num", "nume" => "char", "prenume" => "char", "tara" => "char", "data_nasterii" => "date"], "A_PARTICIPAT" => ["id_sportiv" => "num", "id_concurs" => "num", "loc" => "num", "premiu" => "char"], "NOTIFICARI" => ["id_user" => "num", "id_concurs" => "num"]);        

    require 'conexiune.php';
    function where_statement($tabel, &$coloane_tabel){
        $coloane_select = array("USERS" => ["id", "nume", "prenume"], "CONCURSURI" => ["id", "nume", "sport"], "SPORTIVI" => ["id", "nume", "prenume"], "A_PARTICIPAT" => ["id_sportiv", "id_concurs"], "NOTIFICARI" => ["id_user", "id_concurs"]);

        $targets = explode(" ", $_POST['target']);
        $sz = sizeof($targets);
            
        $col = $coloane_select[$tabel][0];
        $str = ' WHERE ';
        $first = True;
        for ($i = 0; $i < $sz; $i++) {
            if(!$first)
                $str = $str.' AND ';
            else
                $first = False;
            $col = $coloane_select[$tabel][$i];
            switch($coloane_tabel[$tabel][$col]){
                case "num":
                    $str = $str.$col.' = '.$targets[$i];
                    break;
                default:
                    $str = $str.$col.' = '."'".$targets[$i]."'";
            }
        }
        return $str;
    }

    switch($act){
        case 'DELETE':
            $w = where_statement($tabel, $coloane_tabel);
            $query = "DELETE FROM ".$tabel.$w;
            break;

        case 'MODIFY':
            $w = where_statement($tabel, $coloane_tabel);
            $str = "UPDATE ".$tabel." SET ";
            $first = True;
        foreach($_POST as $label => $val){
            if($label != "action" && $label != "tabel" && $label != "target" && $val){
                if(!$first)
                    $str = $str.', ';
                else
                    $first = False;
                switch($coloane_tabel[$tabel][$label]){
                    case "num":
                        $str = $str.$label.' = '.$val;
                        break;
                    default:
                        $str = $str.$label.' = '."'".$val."'";
                    }
                }
            }
            $query = $str.$w;
            break;

        case 'INSERT':
            $str = "INSERT INTO ".$tabel." (";
            $v = "VALUES (";
            $first = True;
            foreach($_POST as $label => $val){
                if($label != "action" && $label != "tabel" && $label != "target" && $val){
                    if(!$first){
                        $str = $str.', ';
                        $v = $v.', ';
                    }
                    else
                        $first = False;
                    $str = $str.$label;
                    $v = $v."'".$val."'";
                }
            }
            $query = $str.") ".$v.")";
            break;
                
        default:
            echo "cum ai ajuns aici?";
    }

    $link->query($query);
    mysqli_close($link);
    header("Location: admin.php");
?>