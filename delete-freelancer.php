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

if(isset($_POST['deleteFreelancer'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $u = new users();
    $selectedUser = $u->getUserById($db, $_SESSION['userid']);

    $f = new Freelancer();
    $count = $f->deleteFreelancer($db, $_SESSION['userid']);

    if($count){
        header("Location: freelancer-profile.php");
    }
    else {
        echo "Something Went Wrong";
    }
}
