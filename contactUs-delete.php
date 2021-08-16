<?php
require_once "models/Database.php";
require_once "models/contactUsUsers.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $u = new contactUsUsers();
    $result = $u->deleteMessage($db,$id);
    if($result){
        header("Location: Admin_Dashboard_ContactUs.php");
    }
    else {
        echo " problem deleting!";
    }
}