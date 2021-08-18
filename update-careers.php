<?php

require_once 'models/Database.php';
require_once 'models/careers.php';
$dbcon = Database::getDb();
$c = new careers();
$job_title = $job_description = $expected_pay = $id = '';
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $selectedCareer = $c->getCareersById($dbcon, $id);
    $job_title = $selectedCareer->job_title;
    $job_description = $selectedCareer->job_description;
    $expected_pay = $selectedCareer->expected_pay;
}
if (isset($_POST['updateCareer'])) {
    $count = $c->updateCareer($dbcon, $id, $_POST['job_title'], $_POST['job_description'], $_POST['expected_pay']);

    if ($count) {
        header('Location:list-careers.php');
    } else {
        header('Location : custom-error.php');
    }
}
?>

<form method="POST">
    <div class="form-elements">
        <label for="job_title">Job Title: </label>
        <input type="text" id="job_title" name="job_title" placeholder="Job Title" value="<?= $job_title; ?>">
    </div>

    <div class="form-elements">
        <label for="job_description">Job Description:</label>
        <textarea cols="10" rows="5" style="max-width: 600px;" id="job_description" name="job_description" placeholder="Enter the job description"><?= $job_description; ?></textarea>
    </div>
    <div class="form-elements">
        <label for="expected_pay">Expected Pay(per hour): </label>
        <input type="text" id="expected_pay" name="expected_pay" placeholder="Expected pay" value="<?= $expected_pay; ?>">
    </div>
    <div class="submit-section">
        <button class="submit-Button" type="submit" id="submit" name="updateCareer">Update Career</button>
    </div>
</form>