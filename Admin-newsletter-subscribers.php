
<?php

    require_once('Models/Database.php');
    require_once ('Models/users.php');

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
    $u = new users();
    $users = $u->listUsers($dbcon);

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
                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($users as $user)
                    {
                        ?>
                    <tr>
                        <td> <?= $user->id?></td>
                        <td> <?= $user->preferred_user_name?></td>
                        <td><?= $user->email?> </td>
                        <td><?= $user->phone_number?> </td>
                        <td><?= $user->role_name?></td>
                        <td>
                            <form action="./update-user.php" method="post">
                                <input type="hidden" name="id" value="<?= $user->id; ?>"/>
                                <input type="submit" class="button btn btn-primary" name="updateUser" value="Update"/>
                            </form>
                        </td>
                        <td>
                            <form action="./delete-user.php" method="post">
                                <input type="hidden" name="id" value="<?=  $user->id; ?>"/>
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


