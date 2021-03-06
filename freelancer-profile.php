<?php

require_once('models/Database.php');
require_once('models/users.php');
require_once('models/Freelancer.php');

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

$dbcon = Database::getDb();
$u = new users();
$selectedUser = $u->getUserById($dbcon, $_SESSION['userid']);

$f = new freelancer();

$results = $f->getFreelancerByUserId($dbcon, $_SESSION['userid']);



?>

<html lang="en">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/freelancer-profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Freelancer Profile</title>

<body>

<?php include "header.php";?>

<div class="profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="./images/avatar.jpg" alt="your photo"/>
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?= $selectedUser->preferred_user_name?>
                    </h5>
                    <h6>
                        Freelancer
                    </h6>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="profile-work">
                    <p><a href="Freelancer-Dashboard-Project-list.php">Projects List:</a></p>
                    <a href="">Building e-commerce website</a><br/>
                    <a href="">PHP project for school</a><br/>
                    <a href="">Financial system for accountant </a>
                </div><br>
                <div class="col-md-2">
                     <?php if (!(isset($results->profession))){
                       ?>
                         <a href="add-freelancer.php" id="btn_addFreelancer" class="button btn btn-success mb-2">Add Information</a>
                     <?php } ?>
                    <a href="update-freelancer.php?id=<?= $selectedUser->id?>" id="btn_updateFreelancer" class="button btn btn-primary mb-2">Update Information</a>
                    <form action="update-freelancer.php" method="post">
                    </form>
                    <form action="./delete-freelancer.php" method="post">
                        <input type="hidden" name="id" value="<?= $selectedUser->id?>"/>
                        <input type="submit" class="button btn btn-danger mb-2" name="deleteFreelancer" value="Delete Information"/>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $selectedUser->id?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $selectedUser->preferred_user_name?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $selectedUser->email?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= $selectedUser->phone_number?></p>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Profession</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= isset($results->profession)? $results->profession:'Please add inforamtion'; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Skills</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= isset($results->skills)? $results->skills:'Please add inforamtion'; ?></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Linked-In</label>
                            </div>
                            <div class="col-md-6">
                                <p><?= isset($results->linked_in)? $results->linked_in:'Please add inforamtion'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include "footer.php";
include "bootstrapjsfile.php";?>

</body>

</html>
