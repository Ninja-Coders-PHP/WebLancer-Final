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
//$count = $f->addFreelancer($dbcon,$_SESSION['userid'],'Web Developer', '.NET', 'xyz');


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
                    <p><a href="freelancer-Dashboard-Project-list.php">Projects List:</a></p>
                    <a href="">Building e-commerce website</a><br/>
                    <a href="">PHP project for school</a><br/>
                    <a href="">Financial system for accountant </a>
                </div><br>
                <div class="col-md-4">
                    <form action="./update-.php" method="post">
                        <input type="hidden" name="id" value=""/>
                        <input type="submit" class="button btn btn-success" name="updateFreelancer" value="Add Information"/>
                    </form><br><br>
                    <form action="./update-.php" method="post">
                        <input type="hidden" name="id" value=""/>
                        <input type="submit" class="button btn btn-primary" name="updateFreelancer" value="Update Information"/>
                    </form>
                    <form action="./delete-.php" method="post">
                        <input type="hidden" name="id" value=""/>
                        <input type="submit" class="button btn btn-danger" name="deleteFreelancer" value="Delete Information"/>
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
                                <p></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Skills</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Linked-In</label>
                            </div>
                            <div class="col-md-6">
                                <p></p>
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
