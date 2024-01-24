<?php
    if(!$_GET)
        header('Location: index.php');
    if(!isset($_SESSION))
        require 'sesiune.php';
    if($_SESSION['rol'] == 'guest')
        header('Location: index.php');

    $concurs = $_GET['id'];
    $action = $_GET['action'];
    require_once 'conexiune.php';
    switch($action){
        case 'save':
            $save_query = $link->prepare("INSERT INTO NOTIFICARI (id_user, id_concurs) VALUES (?, ?)");
            $save_query->bind_param("ss", $_SESSION['userId'], $concurs);
            $save_query->execute();
            break;
        case 'remove':
            $remove_query = $link->prepare("DELETE FROM NOTIFICARI WHERE id_user = ? AND id_concurs = ?");
            $remove_query->bind_param("ss", $_SESSION['userId'], $concurs);
            $remove_query->execute();
            break;
        default:
            header('Location: index.php');
            break;
    }
    header('Location: concurs.php?id='.$concurs);
?>