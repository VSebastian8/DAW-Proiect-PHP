<?php 
    if(!isset($_SESSION))
        require 'sesiune.php';
    if(!isset($_SESSION['rol']))
        header('Location: ./index.php');
    if($_SESSION['rol'] != 'admin')
        header('Location: ./index.php');
?>  

<html>
<head>
    <title>Admin Page</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Balinese&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = "admin.css" type="text/css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="admin.js"></script>
</head>
<body>
<div id = "navigation">
    <a href = "index.php"> BACK </a>
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
    <div id = "methods">
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
</div>
</body>
<html>