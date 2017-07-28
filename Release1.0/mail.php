


<?php

 include_path 'C:\xampp\php\PEAR'; 
require_once "vendor/autoload.php";

//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "marian.vladoi@gmail.com";
$mail->FromName = "Vladoi Marian";

//To address and name
$mail->addAddress("mvladoi@ucsc.edu", "Recepient Name");
$mail->addAddress("vladoimarian@yahoo.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("marian.vladoi@gmail.com", "Reply");

//CC and BCC
$mail->addCC("cc@example.com");
$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}