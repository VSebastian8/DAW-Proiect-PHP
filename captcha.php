<?php
    $recaptcha = $_POST['g-recaptcha-response'];
    $secret_key = '6LdkUkUpAAAAALJnUpYpe-VHbmJi93azEhvMyRxO'; 

    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$recaptcha; 

    $response = file_get_contents($url); 
    $response = json_decode($response); 

    if ($response->success == false) { 
        header('Location: login.php');
        exit();
    }
?>