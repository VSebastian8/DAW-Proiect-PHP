<html>
<head>
    <title> Home Page</title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href = "https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href = "home.css" type = "text/css">
    <script type="text/javascript" src="home.js"></script>
</head>
<body>
    <div id = "container">
    <div id = "navigation_bar"> 
        <?php
            if(!isset($_SESSION))
                require 'sesiune.php';
            if(!isset($_SESSION['username'])){
                $_SESSION['username'] = 'Guest';
                $_SESSION['rol'] = 'guest';
            }
            echo '<a id = "userName">'.$_SESSION['username'].'</a>';

            if($_SESSION['rol'] == 'guest'){
                echo '<a href = "login.php"> Login </a>';
                echo '<a></a>';
                echo '<a></a>';
            }
            else{
                echo '<a id = "notificari">Notificari</a>';
                echo '<div id = "notificari-content" class = " flex invisible">';
                require 'notificari.php';
                echo '</div>';

                echo '<a id = "setari">Setari</a>';
                echo '<div id = "setari-content" class = "flex invisible">';
                echo '<a href = "login.php">Log out</a> <hr>';
                echo '<a>Date Cont</a> <hr> <a>Serge Cont</a>';
                if($_SESSION['rol'] == 'admin'){
                    echo '<hr> <a href = "admin.php">Admin</a>';
                }
                echo '</div>';
            }
        ?>
    </div>
    <div id = "text_box">
        <h1 id = 'res'>Home Page</h1>
        <h3>Scurtaaaaaă descriere a siteului pentru DAW PHP</h3>
            <p>Site-ul va afișa date despre rezultatele diferitor <a class = "highlight">concursuri sportive</a>. Vor exista conturi de <a class = "highlight">utilizator</a> (autentificare prin formular) și de <a class = "highlight">admin</a> (poate adăuga/șterge concursuri). </p>
        <h3>Funcționalități</h3>
            <ul>
                <li>Se pot vizualiza concursurile după <a class = "highlight">sport</a></li>
                <li>Se pot vizualiza cele mai <a class = "highlight">recente</a> concursuri</li>
                <li>Utilizatorii pot salva diferite concursuri; vor fi <a class = "highlight">notificați</a> cu update-uri pentru acestea</li>
                <li>Se poate accesa profilul unui <a class = "highlight">sportiv</a>, afișând concursurile la care a participat acesta</li>
            </ul>
        <h3>Baza de Date</h3>
            <ul> 
                <li><a class = "highlight">USERS</a> (id, nume, prenume, email, parola)</li>
                <li><a class = "highlight">CONCURSURI</a> (id, nume, sport, data)</li>
                <li><a class = "highlight">SPORTIVI</a> (id, nume, prenume, tara, data_nasterii)</li>
                <li><a class = "highlight">A_PARTICIPAT</a>  (id_sportiv, id_concurs, loc, premiu)</li>
                <li><a class = "highlight">NOTIFICARI</a> (id_user, id_concurs)</li>
            </ul>
    </div>

    </div>
    </div>
</body>
</html>