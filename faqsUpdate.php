<?php

require_once('Models/Database.php');
require_once ('Models/faqs.php');

$que = $ans = "";
$f = new faqs();
if(isset($_POST['updateFAQ'])){
    $id= $_POST['id'];

    $db = Database::getDb();
    $faqs = $f->getFAQById($db,$id);

    $que =  $faqs->question;
    $ans = $faqs->answer;

}

if(isset($_POST['update_faq'])){
    $id= $_POST['faqid'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    $db = Database::getDb();
    $count = $f->updateFAQ($db,$id, $question, $answer);
    if($count){
        header('Location: faqsAdmin.php');
    } else {
        echo "Problem occured!";
    }
}


?>
<html lang="en">
<head>
    <title>FAQs-Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
include "header.php";
?>
<body>
    <div class="container">
        <form action="" method="post">
            <input type="hidden" name="faqid" value="<?= $id; ?>" />
            <div class="form-group">
                <label for="desc">Question :</label>
                <input type="text" class="form-control" name="question" id="question" value="<?= $que; ?>"
                   placeholder="Write Question">

            </div>
            <div class="form-group">
                <label for="project_name">Answer :</label>
                <input type="text" class="form-control" name="answer" id="answer"  value="<?= $ans; ?>"
                   placeholder="Write Answer">

            </div>
        
            <button><a href="./faqsAdmin.php" id="back_button" class="form-elements float-left">Back</a></button>
            <button type="submit" name="update_faq"
                class="form-elements float-right" id="btn-submit">Update FAQ</button>
        </form>
    </div>
    
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>