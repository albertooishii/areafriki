<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    require_once 'vendor/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 1;

    $mail->Host = "areafriki.com";
    $mail->Port = 465;
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = "tls";
    $mail->Username = "noreply@areafriki.com";
    $mail->Password = "YDbTDs+19391938AfNR";
    $mail->setFrom("noreply@areafriki.com", "noreply@areafriki.com");
    $mail->addReplyTo("noreply@areafriki.com", "noreply@areafriki.com");
    $mail->addAddress("alberto@sirym.com", "alberto@sirym.com");
    $mail->Subject = "asunto de mierda";
    //$mail->AltBody="Cuerpo alternativo del mensaje en solo texto";
    $mail->msgHTML("<h1>funcionia</h1>");
    //$mail->AddAttachment("ruta/archivoadjunto.jpg");
    $mail->CharSet = "UTF-8";
    //$mail->Encoding = "quotedprintable";
    echo "llega"; 
    if ($mail->Send())
    {return true;}
    else
    {   echo "me cago en tu m adre";
        //$mail->ErrorInfo;
     return false;}


?>