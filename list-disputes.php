<?php


require_once 'models/Database.php';
require_once 'models/Project.php';
require_once 'models/Dispute.php';
require_once "Library/form-functions.php";




$s = new Dispute();
$statuses = $s->getStatuses(Database::getDb());

$status = $_GET['status'] ?? "";
if(isset($_GET['status'])){
    $disputes = $s->getDisputesInStatus(Database::getDb(), $_GET['status']);
} else {
    $disputes =  $s->getAllDisputes(Database::getDb());
}


?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/freelancer-profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <title>Employer Disputes</title>
</head>

<body>
<?php include "header.php";?>
<p class="h1 text-center">Dispute Management System</p>
<div class="form-element-wrapper">
    <form action="" method="get">
        <div class="form-elements">
            <label for="status">Status :</label>
            <select  name="status" class="form-control"
                     id="status" >
                <?php echo  populateDropdownStatus($statuses, $status) ?>
            </select>
            <span style="color: red">

            </span>
        </div>
        <input class="form-elements" type="submit" class="button btn btn-primary" name="disputeinstatus" value= "Show Disputes" />
    </form>
</div>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Status</th>
            <th scope="col">Subject</th>
            <th scope="col">Project Name</th>
            <th scope="col">Last Message</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($disputes as $dispute) { ?>
            <tr>
                <th><?= $dispute->id; ?></th>
                <td><?= $dispute->status; ?></td>
                <td><?= $dispute->subject; ?></td>
                <td><?= $dispute->project_name; ?></td>
                <td><?= $dispute->last_message; ?></td>

                <td>
                    <form action="./update-dispute.php" method="post">
                        <input type="hidden" name="id" value="<?= $dispute->id; ?>"/>
                        <input type="submit" class="form-elements" name="updateDispute" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="delete-dispute.php" method="post">
                        <input type="hidden" name="id" value="<?=  $dispute->id; ?>"/>
                        <input type="submit" class="form-elements" name="deleteDispute" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


</div>
<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>
















