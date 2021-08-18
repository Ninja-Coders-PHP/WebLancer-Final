<?php

require_once('Models/Database.php');
require_once('Models/feedback.php');

session_start();

$dbcon = Database::getDb();

$f = new feedback();

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}
$user_id = $_SESSION['userid'];

if (isset($_POST["submit"])) {
    $count = $f->addFeedback($dbcon, $user_id, $_POST["rate"], $_POST["reviews"]);

    var_dump($count);
    if ($count) {
        header('Location:listfeedback.php');
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
        <title>WebLancer-Home</title>
    </head>

    <body>
        <?= include "header.php"; ?>

        <body>
            <h2>Please rate your experience with this website</h2>
            <form method="POST">
                <div>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>
                <div>
                    <label for="reviews"></label>
                    <textarea name="reviews" style="max-width: 600px;" id="reviews" rows="6" placeholder="Feedback"></textarea>
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