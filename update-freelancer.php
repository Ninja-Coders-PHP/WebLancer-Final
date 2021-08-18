<?php

require_once ('models/Database.php');
require_once ('models/users.php');
require_once ('models/Freelancer.php');

session_start();
if(!isset($_SESSION['userid'])){
    header('Location: login.php');
}
else
{
    if($_SESSION['role'] != 'Freelancer')
    {
        header('Location: login.php');
    }
}

$profession = $skills = $linked_in = "";

$selectedUserId = $_GET['id'];

    $dbcon = Database::getDb();

    $u = new users();
    $selectedUser = $u->getUserById($dbcon, $_SESSION['userid']);

    $f = new freelancer();
    $results = $f->getFreelancerByUserId($dbcon, $_SESSION['userid']);

    $profession = $results->profession;
    $skills = $results->skills;
    $linked_in = $results->linked_in;

if(isset($_POST['updateFreelancer'])){
    $id= $_POST['id'];
    $user_id = $selectedUserId;
    $profession = $_POST['profession'];
    $skills = $_POST['skills'];
    $linked_in = $_POST['linked_in'];

    $db = Database::getDb();

    $f = new Freelancer();
    $count = $f->updateFreelancer($db, $id, $user_id, $profession, $skills, $linked_in);

    if($count){
        header('Location: freelancer-profile.php');
    } else {
        echo "Something Went Wrong";
    }
}

?>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/freelancer-profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Freelancer Profile</title>

<body>

<?php include "header.php";?>

<div class="profile">
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $results->id; ?>" />
        <div class="col-md-12">
            <label for="profession">Profession:</label>
            <input type="text" class="form-control" name="profession" id="profession" value="<?= $profession; ?>"
                   placeholder="Enter Profession">
            <span style="color: red">

            </span><br>
        </div>
        <div class="col-md-12">
            <label for="skills">Skills:</label>
            <input type="text" class="form-control" id="skills" name="skills"
                   value="<?= $skills; ?>" placeholder="Enter Skills">
            <span style="color: red">

            </span><br>
        </div>
        <div class="col-md-12">
            <label for="linked_in">Linked-In Profile:</label>
            <input type="text" name="linked_in" value="<?= $linked_in; ?>" class="form-control"
                   id="linked_in" placeholder="Enter Linked-In Profile">
            <span style="color: red">

            </span>
        </div><br>
        <a href="./freelancer-profile.php" id="btn_back" class="btn btn-success align-left">Back</a>
        <button type="submit" name="updateFreelancer"
                class="btn btn-primary float-right" id="btn-submit">
            Update Information
        </button>
    </form><br>
</div>

<?php include "footer.php";
include "bootstrapjsfile.php";?>

</body>

</html>