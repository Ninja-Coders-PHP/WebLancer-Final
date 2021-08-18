
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
$dbcon = Database::getDb();
$n = new newsletter_details();
$newsLetters = $n->getAllNewsletter($dbcon);

// username - admin
// Password - admin
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
        <h1>List of all Newsletter</h1>
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Subject</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach($newsLetters as $newsLetter)
            {
                ?>
                <tr>
                    <td> <?= $newsLetter->id?></td>
                    <td> <a href ="newsletter-detail.php?id=<?= $newsLetter->id?>"><?= $newsLetter->subject?></a></td>
                    <td><?= $newsLetter->created_date?> </td>
                    <td>
                        <form action="./send-newsletter.php" method="post">
                            <input type="hidden" name="id" value="<?=  $newsLetter->id; ?>"/>
                            <input type="submit" class="button btn btn-primary" name="send" value="Send"/>
                        </form>
                    </td>
                    <td>

                    </td>
                    <td>
                        <form action="./" method="post">
                            <input type="hidden" name="id" value="<?=  $newsLetter->id; ?>"/>
                            <input type="submit" class="button btn btn-primary" name="update" value="Update"/>
                        </form>
                    </td>
                </tr>
            <? }
            ?>

            </tbody>
        </table>
    </section>

</main>
<footer>
    <?= include_once "footer.php";
    include_once "bootstrapjsfile.php";
    ?>
</footer>
</body>
</html>


<?php
