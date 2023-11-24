<?php
    if($_POST){
        
        $coloane_tabel = array("USERS" => ["id" => "num", "nume" => "char", "prenume" => "char", "email" => "char", "parola" => "char"], "CONCURSURI" => ["id" => "num", "nume" => "char", "sport" => "char", "data" => "date"], "SPORTIVI" => ["id" => "num", "nume" => "char", "prenume" => "char", "tara" => "char", "data_nasterii" => "date"], "A_PARTICIPAT" => ["id_sportiv" => "num", "id_concurs" => "num", "loc" => "num", "premiu" => "char"], "NOTIFICARI" => ["id_user" => "num", "id_concurs" => "num"]);

        $act = $_POST['action'];
        $tabel = $_POST['tabel'];

        $link = mysqli_connect("mysql-vsebastian.alwaysdata.net", "336088", "DawBD08*", "vsebastian_dt");
        if (!$link) {
            echo "Error: Unable to connect to MySQL.";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }

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
                echo $query;
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
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
?>

<html>
<head>
    <title>CRUD</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "database.css" type="text/css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="database.js"></script>
</head>
<body>
<div id = "navigation">
    <a href = "index.html"> DESCRIERE </a>
    <a href = "login.html"> LOGIN </a>
</div>
<div class = "form-container">
    <a>Tabel</a>
    <form>
    <select name = "tabele" onchange = " show_tabel (this.value)">
        <option value = "users"> USERS </option>
        <option value = "concursuri"> CONCURSURI </option>
        <option value = "sportivi"> SPORTIVI </option>
        <option value = "a_participat"> A_PARTICIPAT </option>
        <option value = "notificari"> NOTIFICARI </option>
    </select>
    </form>
</div>
<div id = "table_container">
</div>
<div class = "form-container">
    <a>Delete</a>
    <form id = 'form-delete' action = 'database.php' method = 'POST'>
    </form>    
</div>
<div class = "form-container">
    <a>Modify</a>
    <form id = 'form-modify' action = 'database.php' method = 'POST'>
    </form>    
</div>
<div class = "form-container">
    <a>Insert</a>
    <form id = "form-insert" action = 'database.php' method = 'POST'>
    </form>
</div>
</body>
<html>