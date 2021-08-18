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
$desc = $project_name = $freelancer_id = $status =$user_id= "";
$s = new Project();
$statuses = $s->getStatuses(Database::getDb());
$freelancers = $s->getFreelancers(Database::getDb());

function populateDropdownFreelancer($freelancers, $select = ""){
    $html_dropdown = "";
    foreach ($freelancers as $freelancer) {
        $selected = $select == $freelancer->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$freelancer->id'>$freelancer->first_name $freelancer->last_name</option>";
    }

    return $html_dropdown;
}

if(isset($_POST['updateProject'])){
    $id= $_POST['id'];

    $db = Database::getDb();

    $project = $s->getProjectById($id, $db);

    $desc =  $project->desc;
    $project_name = $project->project_name;
    $status = $project->status;
    $stat_id = $project->status_id;
    $freelancer_id = $project->freelancer_ID;
    $user_id = $project->user_id;

}

if(isset($_POST['updProject'])){
    $id= $_POST['sid'];
    $desc = $_POST['desc'];
    $project_name = $_POST['project_name'];
    $status = $_POST['status'];
    $freelancer_id = $_POST['freelancer_id'];
    $user_id = $_POST['user_id'];
    $db = Database::getDb();
    $count = $s->updateProject($id, $desc, $project_name, $freelancer_id, $status, $db,$user_id);

    if($count){
        header('Location:  list-projects.php');
    } else {
        echo "problem";
    }
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




<div>
    <!--    Form to Update  Project -->
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="desc">Description :</label>
            <input type="text" class="form-control" name="desc" id="desc" value="<?= $desc; ?>"
                   placeholder="Enter desc">
            <span style="color: red">

            </span>
        </div>
        <input type="text" value="<?= $user_id?>" name="user_id" class="hidden">
        <div class="form-group">
            <label for="project_name">Project Name :</label>
            <input type="text" class="form-control" id="project_name" name="project_name"
                   value="<?= $project_name; ?>" placeholder="Enter project_name">
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="freelancer_id">Freelancer Name :</label>
            <select name="freelancer_id" class="form-control" id="freelancer_id">
                <?php echo  populateDropdownFreelancer($freelancers, $freelancer_id) ?>
            </select>

        </div>
        <div class="form-group">
            <label for="status">Status :</label>
            <select  name="status" class="form-control"
                     id="status" >
                <?php echo  populateDropdownStatus($statuses, $stat_id) ?>
            </select>
            <span style="color: red">

            </span>
        </div>
        <button><a href="list-projects.php" id="btn_back" class="form-elements float-left">Back</a></button>
        <button type="submit" name="updProject"
                class="form-elements float-right" id="btn-submit">
            Update Project
        </button>
    </form>
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html

