
<?php

    require_once('models/Database.php');
    require_once('models/newsletter_Subscribers.php');

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
    $ns = new newsletter_Subscribers();
    $subscribers = $ns->getAllSubscribers($dbcon);

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
            <h1>List of all Subscribers</h1>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($subscribers as $subscriber)
                    {
                        ?>
                    <tr>
                        <td> <?= $subscriber->id?></td>
                        <td> <?= $subscriber->email_id?></td>
                        <td><?= $subscriber->name?></td>
                        <td>
                            <form action="./update-newsletter-subscribers.php" method="post">
                                <input type="hidden" name="id" value="<?= $subscriber->id; ?>"/>
                                <input type="submit" class="button btn btn-primary" name="update" value="Update"/>
                            </form>
                        </td>
                        <td>
                            <form action="./delete-subscriber.php" method="post">
                                <input type="hidden" name="id" value="<?=  $subscriber->id; ?>"/>
                                <input type="submit" class="button btn btn-danger" name="deleteUser" value="Delete"/>
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


