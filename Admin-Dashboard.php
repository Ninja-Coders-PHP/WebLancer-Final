
<?php

    require_once('models/Database.php');
    require_once('models/users.php');

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
            <h2>Some Important Links for Admin</h2>
            <ul>
                <li><h3><a href="Admin_Dashboard_ContactUs.php" >Contact - Us List </a></h3></li>
                <li><h3><a href="Admin_Dashboard_listUser.php">List Users</a></h3> </li>
                <li><h3><a href="Admin-newsletter-subscribers.php">News Letter Subscribers List</a> </h3></li>
                <li><h3><a href="newsletter-list.php">News Letter List</a></h3> </li>
                <li><h3><a href="list-disputes.php">List of Disputes</a></h3> </li>
            </ul>
        </section>

    </main>
    <footer>
        <?= include_once "footer.php";
            include_once "bootstrapjsfile.php";
            ?>
    </footer>
    </body>
    </html>


