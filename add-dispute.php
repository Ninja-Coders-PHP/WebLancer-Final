<?php

require_once 'models/Database.php';
require_once 'models/Dispute.php';
require_once "Library/form-functions.php";

$s = new Dispute();
$statuses = $s->getStatuses(Database::getDb());
$projects = $s->getProjects(Database::getDb());

// To populate a dropdown menu for projects.
function populateDropdownProject($projects, $select = ""){
    $html_dropdown = "";
    foreach ($projects as $project) {
        $selected = $select == $project->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$project->id'>$project->project_name</option>";
    }

    return $html_dropdown;
}

if(isset($_POST['addDispute'])){

    $subject = $_POST['subject'];
    $last_message = $_POST['last_message'];
    $status = $_POST['status'];
    $project_id = $_POST["project_id"];


    $db = Database::getDb();
    $s = new Dispute();
    $c = $s->addDispute($subject, $last_message, $project_id, $status, $db);

    if($c){
        echo "Added project successfully";
    } else {
        echo "problem adding a project";
    }

}
?>


<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/freelancer-DisputeList.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <title>WebLancer - Your Dispute List</title>
</head>
<?php
include "header.php";
?>

<body>

<div>
    <!--    Form to Add  Dispute -->
    <form action="" method="post">

        <div class="form-group">
            <label for="subject">Description :</label>
            <input type="text" class="form-control" name="subject" id="subject" value=""
                   placeholder="Enter subjectription">
            <!--            <span style="color: red">-->
            <!---->
            <!--            </span>-->
        </div>
        <div class="form-group">
            <label for="last_message">Dispute :</label>
            <input type="text" class="form-control" name="last_message" id="last_message"  value=""
                   placeholder="Enter project">
            <!--            <span style="color: red">-->
            <!---->
            <!--            </span>-->
        </div>
        <div class="form-group">
            <label for="project_id">Project Name :</label>
            <select name="project_id" class="form-control" id="project_id">
                <?php echo  populateDropdownProject($projects) ?>
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
        <button><a href="./employer-disputes.php" id="btn_back" class="form-elements float-left">Back</a></button>
        <button type="submit" name="addDispute"
                class="form-elements float-right" id="btn-submit">Add Dispute</button>
    </form>
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>
