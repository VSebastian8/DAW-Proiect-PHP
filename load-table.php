<?php
    function afisare_tabel($tabel, $coloane, $table_class = ""){
    print('<table class = "'.$table_class.'">'); 
    print("<tr>");
    foreach($coloane as $coloana)
        print("<th>".strtoupper($coloana)."</th>");
    print("</tr>");
    foreach($tabel as $rand){
        print("<tr>");
        foreach($coloane as $coloana)
            print("<td>".$rand[$coloana]."</td>");
        print("</tr>");
    }
}
?>
<?php
    $tabel = $_POST['table_name'];
    require 'conexiune.php';
    
    $query="SELECT * FROM ".$tabel;
    $tabel_data = $link->query($query);

    $coloane_tabel = array("USERS" => ["id", "nume", "prenume", "email"], "CONCURSURI" => ["id", "nume", "sport", "data"], "SPORTIVI" => ["id", "nume", "prenume", "tara", "data_nasterii"], "A_PARTICIPAT" => ["id_sportiv", "id_concurs", "loc", "premiu"], "NOTIFICARI" => ["id_user", "id_concurs"]);
   
    afisare_tabel($tabel_data, $coloane_tabel[$tabel]);

    mysqli_close($link);
    exit();
?>