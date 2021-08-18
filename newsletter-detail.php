<?php
require_once('models/Database.php');
require_once('models/newsletter_details.php');

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
$newsLetterId = $_GET['id'];
$dbcon = Database::getDb();
$n = new newsletter_details();
$selectedNewsLetter = $n->getNewsletterById($dbcon,$newsLetterId);
?>
<html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
    <style>
        section{
            padding: 1em 4em;
        }
    </style>
</head>
<body>
<?php
include "header.php";
?>
<main>
    <section >
        <h1>News Letter Detail</h1>
        <a href ="newsletter-list.php">Go back to List</a>
        <div class="py-5">
            <h3>Subject : <?=$selectedNewsLetter->subject?></h3>
            <p><b>Body </b>: <?=$selectedNewsLetter->body?></p>
            <p><b>Created Date </b>: <?=$selectedNewsLetter->created_date?></p>
        </div>
        <div class="d-flex">
            <form action="update-newsletter.php" method="post">
                <input type="hidden" name="id" value="<?=  $selectedNewsLetter->id; ?>"/>
                <input type="submit" class="button btn btn-primary" name="update" value="Update"/>
            </form>
            <form action="delete-newsletter.php" method="post" class="ml-3">
                <input type="hidden" name="id" value="<?=  $selectedNewsLetter->id; ?>"/>
                <input type="submit" class="button btn btn-danger" name="delete" value="Delete"/>
            </form>
        </div>

    </section>

</main>
<footer>
    <?= include_once "footer.php";
    include_once "bootstrapjsfile.php";
    ?>
</footer>
</body>
</html>



