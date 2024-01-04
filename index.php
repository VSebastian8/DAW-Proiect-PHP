<html>
<head>
    <title> Home Page</title>
    <meta charset = "UTF-8">
    <link href = "https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href = "home.css" type = "text/css">
    <script type="text/javascript" src="home.js"></script>
</head>
<body>
    <div id = "container">
    <div id = "navigation_bar"> 
        <img src = "account-icon.svg" id = "account" alt = "account icon"/>
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
            }
            else{
                echo '<a href = "login.php"> Log out </a>';
                echo '<a id = "notificari"> Notificari </a>';
                echo '<div id = "notificari-content"> <a>Cupa Prieteniei</a> <a>Fly High 2024</a> <a>Alt concurs</a>';
                echo '</div>';
                echo '<a id = "setari"> Setari </a>';
                echo '<div id = "setari-content"><a>Nume</a><a>Parola</a><a>Delete Account</a></div>';
            }

            if($_SESSION['rol'] == 'admin'){
                echo '<a href = "admin.php"> Admin </a>';
            }
        ?>
    </div>
    <div id = "text_box">
        <h1>Home Page</h1>
        <h3>Scurtă descriere a siteului pentru DAW PHP</h1>
            <p>Site-ul va afișa date despre rezultatele diferitor <a class = "highlight">concursuri sportive</a>. Vor exista conturi de <a class = "highlight">utilizator</a> (autentificare prin formular) și de <a class = "highlight">admin</a> (poate adăuga/șterge concursuri). </p>
        <h3>Funcționalități</h1>
            <ul>
                <li>Se pot vizualiza concursurile după <a class = "highlight">sport</a></li>
                <li>Se pot vizualiza cele mai <a class = "highlight">recente</a> concursuri</li>
                <li>Utilizatorii pot salva diferite concursuri; vor fi <a class = "highlight">notificați</a> cu update-uri pentru acestea</li>
                <li>Se poate accesa profilul unui <a class = "highlight">sportiv</a>, afișând concursurile la care a participat acesta</li>
            </ul>
        <h3>Baza de Date</h1>
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