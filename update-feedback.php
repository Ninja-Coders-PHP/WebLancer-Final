<?php

require_once 'models/Database.php';
require_once 'models/feedback.php';
$dbcon = Database::getDb();
$f = new feedback();
$stars = $reviews = $user_id = $id = '';
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $selectedFeedback = $f->getFeedbackById($dbcon, $id);
    $star = $selectedFeedback->stars;
    $reviews = $selectedFeedback->reviews;
    $user_id = $selectedFeedback->user_id;
}
if (isset($_POST['updateFeedback'])) {
    $count = $f->updateFeedback($dbcon, $id, $user_id, $_POST['rate'], $_POST['reviews']);

    if ($count) {
        header('Location:listfeedback.php');
    } else {
        header('Location : custom-error.php');
    }
}
?>

<form method="POST">
    <div>
        <h3>Rating:</h3>
        <div class="rate">
            <input type="radio" id="star5" name="rate" value="5" <?= $star == '5' ? 'checked' : ''; ?> />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rate" value="4" <?= $star == '4' ? 'checked' : ''; ?> />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rate" value="3" <?= $star == '3' ? 'checked' : ''; ?> />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rate" value="2" <?= $star == '2' ? 'checked' : ''; ?> />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rate" value="1" <?= $star == '1' ? 'checked' : ''; ?> />
            <label for="star1" title="text">1 star</label>
        </div>
    </div>
    <div>
        <label for=""></label>
        <textarea name="reviews" id="" rows="6" placeholder="Feedback"><?= $reviews; ?></textarea>
    </div>
    <div class="submit-section">
        <button class="submit-Button" type="submit" id="submit" name="updateFeedback">Update Feedback</button>
    </div>
</form>