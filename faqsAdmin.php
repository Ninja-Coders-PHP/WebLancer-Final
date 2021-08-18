<?php
    require_once('Models/Database.php');
    require_once ('Models/faqs.php');

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
    $faqAdmin = new faqs();
    $faqsOb = $faqAdmin->listFAQs($dbconn);
?>
<html>
    <head>
        <title>FAQs</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/css" href="./css/faqs.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>    
        <?php
        include "header.php";
        ?>
        <div class="container">
            <h1>FAQs</h1>
            <div class="jumbotron">
                <?php foreach($faqsOb as $obj) {?>
                <p><strong>Question: </strong> <?= $obj->question ?> </p>
                <p><strong>Answer: </strong> <?= $obj->answer ?></p>
                <div>
                    <form class="update-delete" action="./faqsUpdate.php" method="post">
                        <input type="hidden" name="id" value="<?= $obj->id; ?>"/>
                        <input style="width:150px" type="submit" class="button btn btn-primary" name="updateFAQ" value="Update"/>
                    </form>
                    <form class="update-delete" action="./faqsDelete.php" method="post">
                        <input type="hidden" name="id" value="<?= $obj->id; ?>"/>
                        <input style="width:150px" type="submit" class="button btn btn-danger" name="deleteFAQ" value="Delete"/>
                    </form>
                </div>
                <hr class="mt-2 mb-3"/>
                <?php } ?>
                <form action="./faqsAdd.php" method="post">
                    <input type="hidden" name="id" value="<?= $obj->id; ?>"/>
                    <input style="width:150px" type="submit" class="button btn btn-dark" name="addFAQ" value="Add New"/>
                </form>
                
            </div>
        </div>
        <?= include_once "footer.php";
        include_once "bootstrapjsfile.php";
        ?>
    </body>
</html>