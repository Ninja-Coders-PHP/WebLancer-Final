<?php


require_once 'models/Database.php';
require_once 'models/Project.php';
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
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $s = new Project();
    $count = $s->deleteProject($id, $db);
    if($count){
        header("Location: list-projects.php");
    }
    else {
        echo " problem deleting";
    }


}
