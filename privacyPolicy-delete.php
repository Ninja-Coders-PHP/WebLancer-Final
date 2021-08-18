<?php
require_once "models/Database.php";
require_once "models/privacypolicy.php";
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

$ns = new privacypolicy();
$count = $ns->deletePolicy($db,$id);
if ($count) {
header("Location: privacyPolicy-list.php");
} else {
echo " problem deleting";
}
}