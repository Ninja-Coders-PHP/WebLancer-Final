<?php
require_once "models/Database.php";
require_once "models/users.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $u = new users();
    $count = $u->deleteUser($db,$id);
    if($count){
        header("Location: Admin_Dashboard_listUser.php");
    }
    else {
        echo " problem deleting";
    }
}
