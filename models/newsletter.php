<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


function sendNewsLetter($subscriberInfo,$newsLetter,$is_body_html)
{
    foreach ($subscriberInfo as $subscriber) {
        $mail = new PHPMailer(true);
        // **** You must change the following to match your
        // **** SMTP server and account information.
        $mail->isSMTP();                             // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';              // Set SMTP server
        $mail->SMTPSecure = 'tls';                   // Set encryption type
        $mail->Port = 587;                           // Set TCP port
        $mail->SMTPAuth = true;                      // Enable SMTP authentication
        $mail->Username = 'weblancer243@gmail.com'; // Set SMTP username
        $mail->Password = 'qagbjmyevfpknwsb';           // Set SMTP password

        // Set From address, To address, subject, and body
        $mail->setFrom('weblancer243@gmail.com', 'Web Lancers');
        $mail->addAddress($subscriber->email_id, 'Test');
        $mail->Subject = $newsLetter->subject;
        $mail->Body = "Hi $subscriber->name, <br/> $newsLetter->body";                  // Body with HTML
        $mail->AltBody = strip_tags($newsLetter->body);   // Body without HTML
        if ($is_body_html) {
            $mail->isHTML(true);              // Enable HTML
        }

        if(!$mail->send()) {
            throw new Exception('Error sending email: ' .
                htmlspecialchars($mail->ErrorInfo) );
        }
    }

}