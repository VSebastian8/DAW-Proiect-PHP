<?php
    if(!isset($_POST)){
        header('Location: login.php');
        exit;
    }
    require 'captcha.php';
    require_once('./phpmailer/class.phpmailer.php');
    require_once '.gitignore/secret_mail.php';

    $mail = new PHPMailer(true); 
    $mailBody = "Contul a fost creat cu succes.\nBine ai venit!\nhttps://vsebastian.alwaysdata.net/\n";
    $mail->IsSMTP();
    $user_mail = $_POST['email'];
    try{
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->Host = "smtp.gmail.com";
      $mail->Username   = $site_email;
      $mail->Password   = $site_password;
      $mail->AddReplyTo('no-reply@example.com');
      $mail->AddAddress($user_mail);
      $mail->SetFrom($site_email);
      $mail->Subject = 'Cont Creat';
      
      $mail->MsgHTML($mailBody);   
      $mail->Send();
    }
    catch (phpmailerException $e) {
        echo $e->errorMessage(); //error from PHPMailer
        echo '<a href = "index.php">Ceva nu a mers</a>';
    }

    require_once 'database_user.php';
    header('Location: index.php');
    exit;
?>