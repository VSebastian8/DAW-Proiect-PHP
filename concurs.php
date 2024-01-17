<?php
    if(!$_GET || !$_GET['id'])
        header('Location: index.php');
    $concurs_id = $_GET['id'];
    require 'conexiune.php';
    echo '<a href = "index.php">Go Back</a>';

    $query_concurs = $link->prepare('SELECT nume, sport FROM CONCURSURI WHERE id = ?');    
    $query_concurs->bind_param("i", $concurs_id);
    $query_concurs->execute();
    $result = $query_concurs->get_result();
   
    if($result->num_rows == 0)
        header('Location: index.php');
    $row = $result -> fetch_assoc();
    echo '<hr><img src = "assets/'.strtolower($row['sport']).'.svg" width="50" height="50">';
    echo '<h3>'.$row['nume'].'</h3>';
    
    $query_sportivi = $link->prepare('SELECT sp.nume "nume", sp.prenume "prenume", sp.tara "tara", ap.loc "loc", ap.premiu "premiu" FROM SPORTIVI sp JOIN A_PARTICIPAT ap ON (sp.id = ap.id_sportiv) WHERE id_concurs = ? ORDER BY ap.loc');    
    $query_sportivi->bind_param("i", $concurs_id);
    $query_sportivi->execute();
    $result = $query_sportivi->get_result();
    
    if($result->num_rows == 0)
        echo '<a>Ne pare rau, inca nu avem lista sportivilor care au participat la acest concurs</a>';
    echo '<ul>';
    foreach($result as $row){
        echo '<li class = "sportiv">'.$row['nume'].' | '.$row['prenume'].' | '.$row['tara'].' | '.$row['loc'].' | '.$row['premiu'].'</li>';
    }
    echo '</ul>';
?>