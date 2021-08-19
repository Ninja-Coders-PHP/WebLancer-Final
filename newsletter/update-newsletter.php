<?php

require_once '../models/Database.php';
require_once '../models/newsletter_details.php';
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
$nl = new newsletter_details();
$subject=$body=$dateCreated=$id = '';
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $selectedNewsletter= $nl->getNewsletterById($dbcon,$id);
    $subject = $selectedNewsletter->subject;
    $body =$selectedNewsletter->body;
    $dateCreated = $selectedNewsletter->created_date;
}


if (isset($_POST['updateNewsLetter'])) {
    $nsId = $_POST['nsId'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $flag = 0;
    $date = $_POST['date'];
    if ($subject == '') {
        $subjectErr = "Please Enter a Subject";
        $flag = 1;
    }
    if ($body == '') {
        $bodyErr = "Please Enter the Content of the email.";
        $flag = 1;
    }
    if ($flag == 0) {
        $nl = new newsletter_details();
        $cnt = $nl->updateNewsLetter($dbcon,$nsId, $subject, $body, $date);
        if ($cnt) {
            header('Location:newsletter-list.php');
        } else {
            header('Location : custom-error.php');
        }
    }
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/html" href="../css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
</head>
<body>
<?php include "../header.php"; ?>

<section>
    <main class="page-container">
        <form method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>Update a NewsLetter</h2>
                </div>
                <input type="text" class="hidden" value="<?= $_POST['id'];?>" name = "nsId">
                <input type="text" class="hidden" value="<?= isset($selectedNewsletter->created_date)?$selectedNewsletter->created_date:'';?>" name="date"/>
                <!-- <div class="form-element-wrapper"> -->
                <div class="form-elements">
                    <label for="subject">Subject: </label>
                    <span class="error"><?= isset($subjectErr) ? $subjectErr : ''; ?></span>
                    <input type="text" id="subject" name="subject" placeholder="Subject of Email"
                           value="<?=  $subject ; ?>">
                </div>

                <div class="form-elements">
                    <label for="body">Content of Email:</label>
                    <span class="error"><?= isset($bodyErr) ? $bodyErr : ''; ?></span>
                    <textarea cols="10" rows="5" id="body" name="body"
                              placeholder="Enter the Content of email"> <?= htmlspecialchars($body); ?></textarea>
                </div>

                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="submit" name="updateNewsLetter">Update</button>
                </div>
            </div>
        </form>
    </main>
</section>
<?= include "../footer.php";
include "../bootstrapjsfile.php";
?>
</body>
</html>


