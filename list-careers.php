<?php

require_once('Models/Database.php');
require_once('Models/careers.php');

/*
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}*/

$dbcon = Database::getDb();

$c = new careers();
$results = $c->listCareers($dbcon);

?>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Careers</title>
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
            <form action="./add-careers.php" method="post">
                <input type="hidden" name="id" value="<?= $careers->id; ?>" />
                <input type="submit" class="button btn btn-primary" name="add" value="Add Career posting" />
            </form>

            <h1>List of all Careers</h1>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Job Description</th>
                        <th scope="col">Expecetd Pay (/hr)</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($results as $careers) {
                    ?>
                        <tr>
                            <td><?= $careers->id ?></td>
                            <td><?= $careers->job_title ?></td>
                            <td><?= $careers->job_description ?> </td>
                            <td><?= $careers->expected_pay ?> </td>
                            <td>
                                <form action="./update-careers.php" method="post">
                                    <input type="hidden" name="id" value="<?= $careers->id; ?>" />
                                    <input type="submit" class="button btn btn-warning" name="update" value="Update" />
                                </form>
                            </td>
                            <td>

                            </td>
                            <td>
                                <form action="./delete-careers.php" method="post">
                                    <input type="hidden" name="id" value="<?= $careers->id; ?>" />
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