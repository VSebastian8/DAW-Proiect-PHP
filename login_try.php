<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    if($_POST){
        require 'captcha.php';
        require 'conexiune.php';

        $query = $link->prepare("SELECT * FROM USERS WHERE email = ? AND parola = ?");    
        $query->bind_param("ss", $_POST['lemail'], md5($_POST['lparola']));
        $query->execute();
        $data = $query->get_result();

        if($data->num_rows == 1){
            $row = $data->fetch_assoc();
            print_r($row);
            
            $_SESSION['username'] = $row['prenume'].' '.$row['nume'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['userId'] = $row['id'];
            $_SESSION['rol'] = 'admin';

            mysqli_close($link);
            header('Location: index.php');
            exit();
        }
        else{
            mysqli_close($link);
            header('Location: login.php');
        }
    }
    else{
        $_SESSION['username'] = 'Guest';
        $_SESSION['rol'] = 'guest';
        unset($_SESSION['userId']);
        unset($_SESSION['email']);
        header('Location: login.php');
    }
?>