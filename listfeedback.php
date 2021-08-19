<?php

require_once('models/Database.php');
require_once('models/feedback.php');

/*
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}*/

$dbcon = Database::getDb();

$f = new feedback();
$results = $f->listFeedback($dbcon);

?>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Feedback</title>
    <style>
        section {
            padding: 1em 4em;
        }
    </style>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <main>
        <section>

            <!--<form action="./add-feedback.php" method="post">
                <input type="hidden" name="id" value="<?= $careers->id; ?>" />
                <input type="submit" class="button btn btn-primary" name="add" value="Add Feedback" />
            </form>-->

            <h1>List of all Feedback</h1>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">UserID</th>
                        <th scope="col">Stars</th>
                        <th scope="col">Reviews</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($results as $feedback) {
                    ?>
                        <tr>
                            <td><?= $feedback->id ?></td>
                            <td><?= $feedback->user_id ?></td>
                            <td><?= $feedback->stars ?> </td>
                            <td><?= $feedback->reviews ?> </td>
                            <td>
                                <form action="./update-feedback.php" method="post">
                                    <input type="hidden" name="id" value="<?= $feedback->id; ?>" />
                                    <input type="submit" class="button btn btn-warning" name="update" value="Update" />
                                </form>
                            </td>
                            <td>

                            </td>
                            <td>
                                <form action="./delete-feedback.php" method="post">
                                    <input type="hidden" name="id" value="<?= $feedback->id; ?>" />
                                    <input type="submit" class="button btn btn-danger" name="delete" value="Delete" />
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