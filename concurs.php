<?php
    if(!isset($_GET) || !isset($_GET['id']))
        header('Location: index.php');
    if(!isset($_SESSION))
        require 'sesiune.php';
    $concurs_id = $_GET['id'];
    require 'conexiune.php';

    $query_concurs = $link->prepare('SELECT nume, sport FROM CONCURSURI WHERE id = ?');    
    $query_concurs->bind_param("i", $concurs_id);
    $query_concurs->execute();
    $result = $query_concurs->get_result();

    if($result->num_rows == 0)
        header('Location: index.php');
    $row = $result -> fetch_assoc();
    $concurs_nume = $row['nume'];
    $sport = $row['sport']
    ?>
<html>
<head>
    <title>
<?php
    echo $concurs_nume;
?>
    </title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href = "https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href = "contact.css" type = "text/css">
    <script type="text/javascript" src="concurs.js"></script>
<?php
    echo '<link rel="icon" type="image/x-icon" href="assets/'.$sport.'.svg">';
?>
</head>
<body>
<div id="central">
<div id="navbar"></div>
<div id="spacing"></div>

<div class="content">
<a href = "index.php">Inapoi</a>
<?php
    echo '<hr><img src = "assets/'.strtolower($sport).'.svg" width="50" height="50">';
    if($_SESSION['rol'] != 'guest'){
        $query_notificari = 'SELECT c.id "id" FROM NOTIFICARI n JOIN CONCURSURI c ON (n.id_concurs = c.id) WHERE n.id_user = '.$_SESSION['userId'].' AND c.id = '.$concurs_id.';';
        $result = $link->query($query_notificari);
        if($result->num_rows == 0)
            echo '<button id="save" data_id = "'.$concurs_id.'">SAVE</button>';
        else
            echo '<button id="remove" data_id = "'.$concurs_id.'">UN-SAVE</button>';
    }
?>

<?php
    echo '<h3>'.$concurs_nume.'</h3>';

    $query_sportivi = $link->prepare('SELECT sp.nume "nume", sp.prenume "prenume", sp.tara "tara", ap.loc "loc", ap.premiu "premiu" FROM SPORTIVI sp JOIN A_PARTICIPAT ap ON (sp.id = ap.id_sportiv) WHERE id_concurs = ? ORDER BY ap.loc');    
    $query_sportivi->bind_param("i", $concurs_id);
    $query_sportivi->execute();
    $result = $query_sportivi->get_result();
    
    if($result->num_rows == 0)
        echo '<a>Ne pare rau, inca nu avem lista sportivilor care au participat la acest concurs</a>';
    echo '<table>';
    foreach($result as $row){
        echo '<tr>';
        echo '<td>'.$row['loc'].'</td><td>'.$row['nume'].'</td><td>'.$row['prenume'].'</td><td>'.$row['tara'].'</td><td>'.$row['premiu'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>
</div>
</div>
</body>
</html>