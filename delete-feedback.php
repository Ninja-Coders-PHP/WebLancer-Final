<?php
require_once "models/Database.php";
require_once "models/feedback.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $db = Database::getDb();

    $f = new feedback();
    $count = $f->deleteFeedback($db, $id);
    if ($count) {
        header("Location: listfeedback.php");
    } else {
        echo "Something went wrong.";
    }
}
