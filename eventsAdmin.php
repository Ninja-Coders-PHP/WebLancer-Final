<?php
    require_once('models/Database.php');
    require_once ('models/events.php');

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
    $e = new events();
    $eventsObj = $e->listEvents($dbconn);
?>
<html>
    <head>
        <title>Events - List</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>    
        <?php
        include "header.php";
        ?>
        <section >
            <h1>Details of registered users for events</h1>
            <table class="table table-striped table-dark">                
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach($eventsObj as $event)
                    {
                    ?>
                    <tr>
                        <td> <?= $event->id?></td>
                        <td> <?= $event->first_name?></td>
                        <td> <?= $event->last_name?></td>
                        <td> <?= $event->email?> </td>
                        <td> <?= $event->phone_number?> </td>
                        <td >
                            <form action="./eventsUpdate.php" method="post">
                                <input type="hidden" name="id" value="<?= $event->id; ?>"/>
                                <input style="width:200px" type="submit" class="button btn btn-primary" name="eventsupdate" value="Update"/>
                            </form>
                        </td>
                        <td>
                            <form action="./eventsDelete.php" method="post">
                                <input type="hidden" name="id" value="<?= $event->id; ?>"/>
                                <input style="width:200px" type="submit" class="button btn btn-danger" name="eventsdelete" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
        </section>
        <?= include_once "footer.php";
        include_once "bootstrapjsfile.php";
        ?>
    </body>
</html>