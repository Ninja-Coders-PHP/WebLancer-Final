<?php
    require_once('Models/Database.php');
    require_once ('Models/contactUsUsers.php');

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
    $dbconn = Database::getDb();
    $u = new contactUsUsers();
    $users = $u->listMessages($dbconn);
?>

<html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Contact Us</title>
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
            <h1>Details of contacted users</h1>
            <table class="table table-striped table-dark">
                
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($users as $user)
                    {
                    ?>
                    <tr>
                        <td> <?= $user->id?></td>
                        <td> <?= $user->first_name?></td>
                        <td> <?= $user->last_name?></td>
                        <td> <?= $user->email?> </td>
                        <td> <?= $user->subject?> </td>
                        <td> <?= $user->message?></td>
                        <td >
                            <form action="./contactUs-update.php" method="post">
                                <input type="hidden" name="id" value="<?= $user->id; ?>"/>
                                <input style="width:200px" type="submit" class="button btn btn-primary" name="updateMsgDetail" value="Update"/>
                            </form>
                        </td>
                        <td>
                            <form action="./contactUs-delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $user->id; ?>"/>
                                <input style="width:200px" type="submit" class="button btn btn-danger" name="deleteUser" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                    <?php }
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