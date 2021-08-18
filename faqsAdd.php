<?php
    require_once('Models/Database.php');
    require_once ('Models/faqs.php');

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

    if(isset($_POST['add_faq'])){
        $que = $_POST['question'];
        $ans = $_POST['answer'];
        $dbconn = Database::getDb();
        $faqAdmin = new faqs();
        $faqsOb = $faqAdmin->addFAQ($dbconn,$que,$ans);
        if($faqsOb){
            header('Location: faqsAdmin.php');
        } else {
            echo "problem adding a FAQ!";
        }
    }
    
?>
<html lang="en">
<head>
    <title>FAQs-Add</title>
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

            <div class="form-group">
                <label for="desc">Question :</label>
                <input type="text" class="form-control" name="question" id="question" value=""
                   placeholder="Write Question">

            </div>
            <div class="form-group">
                <label for="project_name">Answer :</label>
                <input type="text" class="form-control" name="answer" id="answer"  value=""
                   placeholder="Write Answer">

            </div>
        
            <button><a href="./faqsAdmin.php" id="back_button" class="form-elements float-left">Back</a></button>
            <button type="submit" name="add_faq"
                class="form-elements float-right" id="btn-submit">Add FAQ</button>
        </form>
    </div>
    
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>