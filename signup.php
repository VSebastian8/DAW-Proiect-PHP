<?php
    if(!isset($_POST)){
        header('Location: login.php');
        exit;
    }
    require 'captcha.php';

    require_once('./phpmailer/class.phpmailer.php');
    $mail = new PHPMailer(true); 
    $mailBody = "Contul a fost creat cu succes.\nBine ai venit!\nhttps://vsebastian.alwaysdata.net/\n";
    $mail->IsSMTP();
    $user_mail = $_POST['email'];
    try{
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->Host = "smtp.gmail.com";      
      $mail->AddReplyTo('no-reply@example.com');
      $mail->Username   = "medalspace.dawphp@gmail.com";
      $mail->Password   = "adqylpmqxayfixmy";
      $mail->AddAddress($user_mail);
      $mail->SetFrom("medalspace.dawphp@gmail.com");
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