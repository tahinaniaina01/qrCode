<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
   
    $mail->isSMTP();
    $mail->Host = 'mail.mit-ua.mg';
    $mail->SMTPAuth = true;
    $mail->Username = 'fnomenjanahary@mit-ua.mg';
    $mail->Password = 'G}Tc4jE%{c?+';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('fnomenjanahary@mit-ua.mg', 'Nomenjanahary');
    $mail->addReplyTo('mfock@mit-ua.mg', 'Fock');

    $mail->addAddress('mfock@mit-ua.mg', 'Fock');

    $mail->isHTML(true);
    $mail->Subject = 'Test email from PHP';
    $mail->Body    = 'This is a test email sent via Gmail SMTP server using PHPMailer.';

 $file_path = './ananas'; 
    $mail->addAttachment($file_path);

    $mail->send();
    echo "Message has been sent\n";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
}
?>
