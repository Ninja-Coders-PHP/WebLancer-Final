<?php

require_once('models/Database.php');
require_once('models/careers.php');

session_start();

$dbcon = Database::getDb();

$c = new careers();

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}
$user_id = $_SESSION['userid'];

if (isset($_POST["submit"])) {
    $count = $c->addCareer($dbcon, $_POST["job_title"], $_POST["job_description"], $_POST["expected_pay"]);

    if ($count) {
        header('Location:list-careers.php');
    } else {
        header('Location : custom-error.php');
    }
}


?>
<section>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="./css/global.css">
        <link rel="stylesheet" type="text/html" href="./css/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>WebLancer-Add Career</title>
    </head>

    <body>
        <?= include "header.php"; ?>

        <body>
            <h2>Please provide job posting details</h2>
            <form method="POST">
                <div class="form-elements">
                    <label for="job_title">Job Title: </label>
                    <input type="text" id="job_title" name="job_title" placeholder="Job Title">
                </div>

                <div class="form-elements">
                    <label for="job_description">Job Description:</label>
                    <textarea cols="10" rows="5" style="max-width: 600px;" id="job_description" name="job_description" placeholder="Enter the job description"></textarea>
                </div>
                <div class="form-elements">
                    <label for="expected_pay">Expected Pay(per hour): </label>
                    <input type="text" id="expected_pay" name="expected_pay" placeholder="Expected pay">
                </div>

                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="submit" name="submit">Submit</button>
                </div>
            </form>
            <footer>
                <?= include_once "footer.php";
                include_once "bootstrapjsfile.php";
                ?>
            </footer>

        </body>

    </html>