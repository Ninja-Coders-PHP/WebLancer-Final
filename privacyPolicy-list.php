<?php
session_start();
include_once "models/Database.php";
include_once "models/privacypolicy.php";
include_once "models/users.php";
$dbcon = Database::getDb();
$pp = new privacypolicy();
$policies = $pp->getAllPolicies($dbcon);
$u = new users();
?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/home.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer -Privacy Policy</title>
</head>
<body>
<?php
include "header.php";
?>
<div class="page-container banner-text container">
    <h2>Privacy Policy</h2>
    <?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin')
    {
        ?>
        <a href="privacyPolicy-add.php" class="button btn btn-success">Add Policy</a>
    <?php
    }
    ?>

    <ul>
        <?php foreach ($policies as $policy)
            { $selectedUsers = $u->getUserById($dbcon,$policy->user_id)
                ?>
                <li><h2><?=$policy->name?></h2></li>
                <ul>
                    <li><p><?=$policy->description?></p></li>


                        <?php
                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin')
                        {
                            ?>
                                <li>Created Date : <b><?=$policy->created_date?></b></li>
                                <li>Modified Date: <b> <?=$policy->modified_date?></b></li>
                                <li>Created By: <b><?=$selectedUsers->first_name ," ",$selectedUsers->last_name?></b> </li>
                               <li>
                                <div class="d-flex">
                            <form action="./privacyPolicy-update.php" method="post" class="mr-3">
                                <input type="hidden" name="id" value="<?= $policy->id; ?>"/>
                                <input type="submit" class="button btn btn-primary" name="updatePolicy" value="Update"/>
                            </form>
                            <form action="./privacyPolicy-delete.php" method="post">
                                <input type="hidden" name="id" value="<?= $policy->id; ?>"/>
                                <input type="submit" class="button btn btn-danger" name="deletePolicy" value="Delete"/>
                            </form>
                                </div>
                               </li>
                            <?php
                        }
                        ?>

                </ul>
           <?php }
            ?>

    </ul>

</div>
<?php
include "footer.php";
include "bootstrapjsfile.php"
?>

</body>

</html>
