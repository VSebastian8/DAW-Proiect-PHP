<html>
<head>
    <title> Descriere Proiect</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "descriere.css" type="text/css">
</head>
<body>
    <div id = "text_box">
        <h1>Scurtă descriere a siteului pentru DAW PHP</h1>
            <p>Site-ul va afișa date despre rezultatele diferitor <a>concursuri sportive</a>. Vor exista conturi de <a>utilizator</a> (autentificare prin formular) și de <a>admin</a> (poate adăuga/șterge concursuri). </p>
        <h1>Funcționalități</h1>
            <ul>
                <li>Se pot vizualiza concursurile după <a>sport</a></li>
                <li>Se pot vizualiza cele mai <a>recente</a> concursuri</li>
                <li>Utilizatorii pot salva diferite concursuri; vor fi <a>notificați</a> cu update-uri pentru acestea</li>
                <li>Se poate accesa profilul unui <a>sportiv</a>, afișând concursurile la care a participat acesta</li>
            </ul>
        <h1>Baza de Date</h1>
            <ul> 
                <li><a>USERS</a> (id, nume, prenume, email, parola)</li>
                <li><a>CONCURSURI</a> (id, nume, sport, data)</li>
                <li><a>SPORTIVI</a> (id, nume, prenume, tara, data_nasterii)</li>
                <li><a>A_PARTICIPAT</a>  (id_sportiv, id_concurs, loc, premiu)</li>
                <li><a>NOTIFICARI</a> (id_user, id_concurs)</li>
            </ul>
        <div>
            <h1> Database: </h1>
            <?php 
            echo '<form method = "POST" action = "database.html">
                    <input type = "submit" value = "see data"/>
                  </form>';
            ?>
        </div>
    </div>
   
</body>
</html>