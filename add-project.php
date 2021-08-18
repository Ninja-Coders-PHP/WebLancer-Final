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
$freelancers = $s->getFreelancers(Database::getDb());

// To populate a dropdown menu for freelancers.
function populateDropdownFreelancer($freelancers, $select = ""){
    $html_dropdown = "";
    foreach ($freelancers as $freelancer) {
        $selected = $select == $freelancer->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$freelancer->id'>$freelancer->first_name $freelancer->last_name</option>";
    }

    return $html_dropdown;
}

if(isset($_POST['addProject'])){

    $desc = $_POST['desc'];
    $project_name = $_POST['project_name'];
    $status = $_POST['status'];
    $freelancer_id = $_POST["freelancer_id"];
    $user_id = $_POST['user_id'];

    $db = Database::getDb();
    $s = new Project();
    $c = $s->addProject($desc, $project_name, $freelancer_id, $status, $db,$user_id);

    if($c){
        header('Location:list-projects.php');
    } else {
        echo "problem adding a project";
    }

}
?>


<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/freelancer-ProjectList.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <title>WebLancer - Your Project List</title>
</head>
<?php
include "header.php";
?>

<body>

<div>
    <!--    Form to Add  Project -->
    <form action="" method="post">

        <div class="form-group">
            <label for="desc">Description :</label>
            <input type="text" class="form-control" name="desc" id="desc" value=""
                   placeholder="Enter description">
<!--            <span style="color: red">-->
<!---->
<!--            </span>-->
        </div>
        <input type="text" name="user_id" value="<?=$_SESSION['userid'];?>" class="hidden">
        <div class="form-group">
            <label for="project_name">Project :</label>
            <input type="text" class="form-control" name="project_name" id="project_name"  value=""
                   placeholder="Enter project">
<!--            <span style="color: red">-->
<!---->
<!--            </span>-->
        </div>
        <div class="form-group">
            <label for="freelancer_id">Freelancer Name :</label>
            <select name="freelancer_id" class="form-control" id="freelancer_id">
                <?php echo  populateDropdownFreelancer($freelancers) ?>
            </select>

        </div>
        <div class="form-group">
            <label for="status">Status :</label>
            <select  name="status" class="form-control" id="status">
                <?php echo  populateDropdownStatus($statuses) ?>
            </select>
<!--            <span style="color: red">-->
<!---->
<!--            </span>-->
        </div>
        <button><a href="./list-projects.php" id="btn_back" class="form-elements float-left">Back</a></button>
        <button type="submit" name="addProject"
                class="form-elements float-right" id="btn-submit">Add Project</button>
    </form>
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>
