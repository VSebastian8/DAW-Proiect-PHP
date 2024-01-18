<?php 
if(isset($_POST['submit'])){ 
    require 'captcha.php';
    if(!isset($_SESSION))
        require 'sesiune.php';

    $name = $_SESSION['username'];
    if($_SESSION['rol'] == 'guest')
        $email = 'guest_email@gmail.com';
    else
        $email = $_SESSION['email'];
    $message = $_POST['content'];
    
    require_once('./phpmailer/class.phpmailer.php');

    $mailBody = "User Name: " . $name . "\n";
    $mailBody .= "User Email: " . $email . "\n";
    $mailBody .= "Message: " . $message . "\n";
    
    $mail = new PHPMailer(true); 
    $mail->IsSMTP();

    try {
        $mail->SMTPDebug  = 3;                     
        $mail->SMTPAuth   = true; 

        $toEmail='medalspace.dawphp@gmail.com';
        $nume='DAW Project';

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; 

        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "medalspace.dawphp@gmail.com";
        $mail->Password   = "adqylpmqxayfixmy"; 
        $mail->AddReplyTo($email, 'DAW - project');
        $mail->AddAddress($toEmail, $nume);
    
        $mail->SetFrom($email, $name);
        $mail->Subject = 'Formular contact';
        $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
        $mail->MsgHTML($mailBody);
        
        $mail->Send();
    }
    catch (phpmailerException $e) {
        echo $e->errorMessage();
    }
}
header('Location: index.php');
exit;
?>