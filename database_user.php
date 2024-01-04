<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    require 'captcha.php';
    require 'conexiune.php';
    $act = $_POST['action'];
    $tabel = 'USERS';

    switch($act){
        case 'INSERT':
            $query = 'INSERT INTO USERS VALUES (NULL,"'.$_POST['nume'].'", "'.$_POST['prenume'].'", "'.$_POST['email'].'", "'. $_POST['parola'].'");';
            $_SESSION['username'] = $_POST['prenume'].' '.$_POST['nume'];
            $_SESSION['email'] = $_POST['email'];
            break;
        case 'DELETE':
            $query = 'DELETE FROM USERS WHERE id = '.$_SESSION['id'].';';
            $_SESSION['username'] = 'Guest';
            $_SESSION['rol'] = 'guest';
            unset($_SESSION['userId']);
            unset($_SESSION['email']);
            break;
        default:
            break;
    }

    $link->query($query);

    if($act == 'INSERT'){
        $id_query = 'SELECT id FROM USERS WHERE nume = "'.$_POST['nume'].'" AND prenume = "'.$_POST['prenume'].'" AND email = "'.$_POST['email'].'";';

        $data = $link->query($id_query);
        $row = $data->fetch_assoc();

        $_SESSION['rol'] = 'user';
        $_SESSION['userId'] = $row['id'];
    }

    mysqli_close($link);
    header('Location: index.php');
?>