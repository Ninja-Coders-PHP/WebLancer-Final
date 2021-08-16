<?php
require_once('Models/Database.php');
require_once ('Models/newsletter_Subscribers.php');
require_once ('Models/newsletter.php');
require_once ('Models/newsletter_details.php');
session_start();
if(!isset($_SESSION['userid'])){
    header('Location: login.php');
}
else
{
    if($_SESSION['role'] != 'Admin')
    {
        header('Location: login.php');
    }
}
$dbcon = Database::getDb();
$message = false;
if(isset($_POST['send']))
{
    $newsLetterId = $_POST['id'];
    $newsletter = new newsletter_details();
    $newsLetterDetail = $newsletter->getNewsletterById($dbcon,$newsLetterId);
    $ns = new newsletter_Subscribers();
    $subscribers  = $ns->getAllSubscribers($dbcon);
    $is_body_html = true;
    try {
        sendNewsLetter($subscribers,$newsLetterDetail,$is_body_html);
          $message = true;
    } catch (Exception $ex) {
        $error = $ex->getMessage();
        include 'custom-error.php';
    }
}
else
{
    header('Location:newsletter-list.php');
}
?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
</head>
<body>
<?php
include "header.php";
?>
<section >
    <main class="page-container">

        <div class="pt-4">
            <?php if($message)
                {?>
                    <h2>Succesfully sent the newsletter with subject<?php if(isset($newsLetterDetail)) {print("****$newsLetterDetail->subject***");}?></h2>
                <?php }?>
        </div>

    </main>
</section>
<?php
include "footer.php";
include "bootstrapjsfile.php";
?>

</body>

</html>
