<?php

require_once('models/Database.php');
require_once('models/feedback.php');
// Turn off all error reporting
error_reporting(0);
session_start();

$dbcon = Database::getDb();

$f = new feedback();



if (isset($_POST["submit"])) {

    if (!isset($_SESSION['userid'])) {
        header('Location: login.php');
    }
    $user_id = $_SESSION['userid'];
    $count = $f->addFeedback($dbcon, $user_id, $_POST["rate"], $_POST["reviews"]);

    var_dump($count);
    if ($count) {
        header('Location:home.php');
    } else {
        header('Location : custom-error.php');
    }
}


?>
<section>




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
                    <textarea name="reviews" style="max-width: 500px;" id="reviews" rows="6" placeholder="Feedback"></textarea>
                </div>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="submit" name="submit">Submit</button>
                </div>
            </form>


</section>
