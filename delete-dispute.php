<?php


require_once 'models/Database.php';
require_once 'models/Dispute.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $s = new Dispute();
    $count = $s->deleteDispute($id, $db);
    if($count){
        header("Location: list-disputes.php");
    }
    else {
        echo " problem deleting";
    }


}

