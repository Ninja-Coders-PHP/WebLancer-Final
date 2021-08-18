<?php
require_once "models/Database.php";
require_once "models/faqs.php";

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $f = new faqs();
    $result = $f->deleteFAQ($db,$id);
    if($result){
        header("Location: faqsAdmin.php");
    }
    else {
        echo " problem deleting!";
    }
}