<html>
  <head>
    <title>Statistici</title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel = "stylesheet" href = "contact.css" type = "text/css">
    <link rel="icon" type="image/x-icon" href="assets/darts.svg">
  </head>
<body>
<div id="central">
<div id="navbar"></div>
<div class="content">
  <a href = "index.php">Inapoi</a>
  <hr>
  <h3>Vizitatorii Acestui Site</h3>
  <?php
    require 'jpgraph/src/jpgraph.php';
    require 'jpgraph/src/jpgraph_pie.php';
    require 'jpgraph/src/jpgraph_bar.php';
    require 'conexiune.php';

    function get_Bar($days, $viz, $gst){
        $graph = new Graph(1000, 600);
        $graph->SetScale('textlin');
        $graph->SetShadow();
        $graph->SetMargin(40,40,20,40);
     
        $userplot = new BarPlot($viz);
        $guestplot = new BarPlot($gst);

        $gbplot = new GroupBarPlot(array($userplot, $guestplot));
       
        $graph->Add($gbplot);

        $userplot->SetColor("white");
        $userplot->SetFillColor("#ff873c");
        
        $guestplot->SetColor("white");
        $guestplot->SetFillColor("#39505c");

        $userplot->legend = 'Users';
        $guestplot->legend = 'Guests';
        $graph->legend->Pos(0.05,0.2, 'right', 'center');
        $graph->legend->SetColumns(1);

        $graph->title->Set('Vizitatori');
        $graph->xaxis->SetTickLabels($days);
        $graph->xaxis->title->Set('Ziua');
        $graph->yaxis->title->Set('Users & Guests');
         
        $graph->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
        $graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
         
        $fimg ='jpbar.png';
        if(file_exists($fimg))
           unlink($fimg, null);
     
        $graph->Stroke($fimg);
        
        if(file_exists($fimg)) echo '<img id="graph" src="'. $fimg .'" />';
        else echo 'Unable to create: '. $fimg;
     }

    $query = $link->prepare("SELECT * FROM VISITS");    
    $query->execute();
    $data = $query->get_result();
    $zile = array();
    $users = array();
    $guests = array();
    foreach($data as $row){
        array_push($zile,'Z '.$row["ziua"].' ');
        array_push($users,intval($row["users"]));
        array_push($guests,intval($row["guests"]));
    }

    get_Bar($zile, $users, $guests);

  ?>
</div>
</div>
</body>
</html>