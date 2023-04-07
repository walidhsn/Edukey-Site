<?php
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/SMTP.php";
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Settings : 
$mail = new PHPMailer();
$mail->Mailer = "smtp";
$mail->isSMTP();
$mail->IsHTML(true);
$mail->Host = "smtp.gmail.com";
$mail->CharSet = 'utf-8';
$mail->SMTPAuth = true; 
$mail->SMTPSecure = "tls";         // Enable TLS encryption; 
$mail->Port = 587;  
$mail->Username = 'edukey.site@gmail.com';                     // SMTP username
$mail->Password = 'root50190957';                               // SMTP password
$mail->SetFrom("edukey.site@gmail.com", "Edukey site"); //FROM

