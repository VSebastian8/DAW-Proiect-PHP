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
                echo '<a id = "notificari" class = "invisible"></a>';
                echo '<a id = "setari" class = "invisible"></a>';
            }
            else{
                echo '<a id = "notificari">Notificari</a>';
                echo '<div id = "notificari-content" class = " flex invisible">';
                require 'notificari.php';
                echo '</div>';

                echo '<a id = "setari">Setari</a>';
                echo '<div id = "setari-content" class = "flex invisible">';
                echo '<a href = "login.php">Log out</a> <hr>';
                echo '<a>Date Cont</a> <hr> <a href = "delete_account.html">Sterge Cont</a>';
                if($_SESSION['rol'] == 'admin'){
                    echo '<hr> <a href = "admin/admin.php">Admin</a>';
                }
                echo '</div>';
            }
        ?>
    </div>
    <div id = "content">
        <h3>Lista Concursuri</h3>
        <ul id = "conc_list">
            <?php
                require 'lista_concursuri.php';
            ?>
        </ul>
    </div>
    </div>
</body>
</html>