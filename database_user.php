<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    require 'captcha.php';
    require 'conexiune.php';
    $act = $_POST['action'];
    $tabel = 'USERS';

    switch($act){
        case 'INSERT':
            $query = $link->prepare('INSERT INTO USERS VALUES (NULL, ?, ?, ?, ?)');    
            $query->bind_param("ssss", $_POST['nume'], $_POST['prenume'], $_POST['email'], md5($_POST['parola']));
            $query->execute();

            $_SESSION['username'] = $_POST['prenume'].' '.$_POST['nume'];
            $_SESSION['email'] = $_POST['email'];
            break;
        case 'DELETE':
            $query = $link->prepare('DELETE FROM USERS WHERE id = ?');    
            $query->bind_param("i", $_SESSION['id']);
            $query->execute();

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
        $query = $link->prepare('SELECT id FROM USERS WHERE nume = ? AND prenume = ? AND email = ?');    
        $query->bind_param("sss", $_POST['nume'], $_POST['prenume'], $_POST['email']);
        $query->execute();
        $data = $query->get_result();

        $data = $link->query($id_query);
        $row = $data->fetch_assoc();

        $_SESSION['rol'] = 'user';
        $_SESSION['userId'] = $row['id'];
    }

    mysqli_close($link);
    header('Location: index.php');
?>