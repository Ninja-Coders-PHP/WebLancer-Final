<?php
require_once 'models/Database.php';
require_once 'models/roles.php';

$dbcon = Database::getDb();
$r = new roles();

$roles = $r->getRoles($dbcon);

?>
<html lang="en">
<head>
    <title>Roles</title>
    <meta name="description" content="Student Management System">
    <meta name="keywords" content="Student, College, Admission, Humber">
</head>
<body>
    <table>
        <tr>
            <th>Role Id</th>
            <th>Role Name</th>
        </tr>

        <?php foreach ($roles as $role )
        {?>
            <tr>
                <td><?= $role->id; ?> </td>
                <td><?= $role->role_name; ?> </td>
            </tr>
        <?php } ?>

    </table>

</body>
</html>
<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'weblancer243@gmail.com';                     //SMTP username
    $mail->Password = 'qagbjmyevfpknwsb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('weblancer243@gmail.com', 'Mailer');
    $mail->addAddress('97manal@gmail.com', 'Joe User');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('nithyahumber@gmail.com');
//    $mail->addBCC('nithyahumber@gmail.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




//    $mail->SMTPOptions = array(
//        'ssl' => array(
//            'verify_peer' => false,
//            'verify_peer_name' => false,
//            'allow_self_signed' => true
//        )
//    );

