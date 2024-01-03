<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    if($_POST){
        require 'conection.php';
        $query="SELECT * FROM USERS WHERE email = '".$_POST['lemail']."' AND parola = '".$_POST['lparola']."';";
        $data = $link->query($query);
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
            header('Location: login.html');
        }
    }
    else{
        $_SESSION['username'] = 'Guest';
        $_SESSION['rol'] = 'guest';
        unset($_SESSION['userId']);
        unset($_SESSION['email']);
        header('Location: login.html');
    }
?>