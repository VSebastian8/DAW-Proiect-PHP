<?php
  if(!isset($_POST['parola'])){
    header('Location: index.php');
    exit;
  }
  if(!isset($_SESSION))
    require 'sesiune.php';

  require 'conexiune.php';
  $user_mail = $_SESSION['email'];
  $user_pass = md5($_POST['parola']);
  $query = $link->prepare("SELECT * FROM USERS WHERE email = ? AND parola = ?");    
  $query->bind_param("ss", $user_mail, $user_pass);
  $query->execute();
  $data = $query->get_result();
  
  if($data->num_rows == 0){
    header('Location: index.php');
    exit;
  }

  require_once('./phpmailer/class.phpmailer.php');
  $mail = new PHPMailer(true); 
  $mailBody = "Contul [".$_SESSION['username']."] a fost sters cu succe.\n";
  $mail->IsSMTP();
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
    $mail->Subject = 'Cont Sters';
    
    $mail->MsgHTML($mailBody);   
    $mail->Send();
    }
    catch (phpmailerException $e) {
        echo $e->errorMessage(); //error from PHPMailer
        echo '<a href = "index.php">Ceva nu a mers</a>';
    }
  require_once 'database_user.php';
 
  session_unset();
  session_destroy();
  header('Location: index.php');
  exit;
?>