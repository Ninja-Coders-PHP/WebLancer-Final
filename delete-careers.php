<?php
require_once "models/Database.php";
require_once "models/careers.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $c = new careers();
    $count = $c->deleteCareer($db, $id);
    if ($count) {
        header("Location: list-careers.php");
    } else {
        echo "Something went wrong.";
    }
}
