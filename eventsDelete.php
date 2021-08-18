<?php
require_once "models/Database.php";
require_once "models/events.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $f = new events();
    $result = $f->deleteEvent($db,$id);
    if($result){
        header("Location: eventsAdmin.php");
    }
    else {
        echo "Problem deleting!";
    }
}