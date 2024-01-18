<?php
    if(!isset($_SESSION))
        require 'sesiune.php';
    if($_POST){
        require 'captcha.php';
        require 'conexiune.php';

        $pass = md5($_POST['lparola']);
        $query = $link->prepare("SELECT * FROM USERS WHERE email = ? AND parola = ?");    
        $query->bind_param("ss", $_POST['lemail'], $pass);
        $query->execute();
        $data = $query->get_result();

        if($data->num_rows == 1){
            $row = $data->fetch_assoc();
            
            $_SESSION['username'] = $row['prenume'].' '.$row['nume'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['userId'] = $row['id'];

            $query_admin = $link->prepare("SELECT * FROM ADMINS WHERE email = ?");    
            $query_admin->bind_param("s", $_POST['lemail']);
            $query_admin->execute();
            $data2 = $query_admin->get_result();
            $_SESSION['rol'] = 'user';
            if($data2->num_rows == 1)
                $_SESSION['rol'] = 'admin';

            $query_visit = $link->prepare("SELECT users FROM VISITS WHERE ziua = CURDATE()");
            $query_visit->execute();
            $data3 = $query_visit->get_result();
            if($data3->num_rows == 0){
                $query_first_visit = $link->prepare("INSERT INTO VISITS VALUES (CURDATE(), 0, 1)");
                $query_first_visit->execute();
            }
            else{
                $row_visits = $data3->fetch_assoc();
                $user_visits = $row_visits['users'] + 1;
                $query_new_visit = $link->prepare("UPDATE VISITS SET users = ? WHERE ziua = CURDATE()");
                $query_new_visit->bind_param("i", $user_visits);
                $query_new_visit->execute();
            }

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