<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


$mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'realestatewebproject06@gmail.com';                    
    $mail->Password   = 'hnqstxesiwflhrxa';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                               


    $mail->setFrom('realestatewebproject06@gmail.com', 'Real Estate');
    $mail->addAddress('senithedirisinghe@gmail.com');     
    
    $mail->addCC($_POST['email']);


    $mail->isHTML(true);                                 
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['message'];
   

    
    $mail->send();
    
    // echo 'Message has been sent';
    echo '<script>alert("Message has been sent")</script>';
    header("Location: ../contactus.html");
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}