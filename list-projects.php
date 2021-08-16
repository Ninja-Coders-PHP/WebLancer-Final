<?php


require_once 'models/Database.php';
require_once 'models/Project.php';
require_once "Library/form-functions.php";

session_start();
if(!isset($_SESSION['userid'])){
    header('Location: login.php');
}
else
{
    if($_SESSION['role'] != 'Employer')
    {
        header('Location: login.php');
    }
}


$s = new Project();
$statuses = $s->getStatuses(Database::getDb());

$status = $_GET['status'] ?? "";
if(isset($_GET['status'])){
   $projects = $s->getProjectsInStatus(Database::getDb(), $_GET['status']);
} else {
    $projects =  $s->getAllProjects(Database::getDb());
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
    <title>Employer Profile</title>
</head>

<body>
<?php include "header.php";?>
<p class="h1 text-center">Project Management System</p>
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
    <input class="form-elements" type="submit" class="button btn btn-primary" name="projectinstatus" value= "Show Projects" />
</form>
</div>
<div class="m-1">
    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Desc</th>
            <th scope="col">Project</th>
            <th scope="col">Status</th>
            <th scope="col">Freelancer ID</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project) { ?>
            <tr>
                <th><?= $project->id; ?></th>
                <td><?= $project->desc; ?></td>
                <td><?= $project->project_name; ?></td>
                <td><?= $project->status; ?></td>
                <td><?= $project->freelancer_ID; ?></td>
                <td>
                    <form action="./update-project.php" method="post">
                        <input type="hidden" name="id" value="<?= $project->id; ?>"/>
                        <input type="submit" class="form-elements" name="updateProject" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="delete-project.php" method="post">
                        <input type="hidden" name="id" value="<?=  $project->id; ?>"/>
                        <input type="submit" class="form-elements" name="deleteProject" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="add-project.php" id="btn_addProject" class="btn btn-primary btn-lg float-right">Add Project</a>

</div>
<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>
















