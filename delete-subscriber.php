<?php

require_once "models/Database.php";
require_once "models/newsletter_Subscribers.php";
session_start();
if(!isset($_SESSION['userid'])){
    header('Location: login.php');
}
else
{
    if($_SESSION['role'] != 'Admin')
    {
        header('Location: login.php');
    }
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $ns = new newsletter_Subscribers();
    $count = $ns->deleteSubscribers($db,$id);
    if ($count) {
        header("Location: Admin-newsletter-subscribers.php");
    } else {
        echo " problem deleting";
    }
}
