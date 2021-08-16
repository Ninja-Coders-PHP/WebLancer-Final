<?php


require_once 'models/Database.php';
require_once 'models/Dispute.php';
require_once "Library/form-functions.php";

$subject = $last_message = $project_id = $status = $id = "";
$s = new Dispute();
$statuses = $s->getStatuses(Database::getDb());
$projects = $s->getProjects(Database::getDb());


function populateDropdownProject($projects, $select = ""){
    $html_dropdown = "";
    foreach ($projects as $project) {
        $selected = $select == $project->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$project->id'>$project->project_name</option>";
    }

    return $html_dropdown;
}

if(isset($_POST['updateDispute'])){
    $id = $_POST['id'];

    $db = Database::getDb();

    $project = $s->getDisputeById($id, $db);

    $subject =  $project->subject;
    $last_message = $project->last_message;
    $status = $project->status;
    $stat_id = $project->status_id;
    $project_id = $project->project_ID;

}

if(isset($_POST['updDispute'])){
    $id= $_POST['sid'];
    $subject = $_POST['subject'];
    $last_message = $_POST['last_message'];
    $status = $_POST['status'];
    $project_id = $_POST['project_id'];

    $db = Database::getDb();
    $count = $s->updateDispute($id, $subject, $last_message, $project_id, $status, $db);

    if($count){
        header('Location:  list-disputes.php');
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
    <!--    Form to Update  Dispute -->
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="subject">Subject :</label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?= $subject; ?>"
                   placeholder="Enter subject">
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="last_message">Last Message :</label>
            <input type="text" class="form-control" id="last_message" name="last_message"
                   value="<?= $last_message; ?>" placeholder="Enter last message">
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="project_id">Project Name :</label>
            <select name="project_id" class="form-control" id="project_id">
                <?php echo  populateDropdownProject($projects, $project_id) ?>
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
        <button><a href="list-disputes.php" id="btn_back" class="form-elements float-left">Back</a></button>
        <button type="submit" name="updDispute"
                class="form-elements float-right" id="btn-submit">
            Update Dispute
        </button>
    </form>
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html


