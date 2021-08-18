<?php

require_once 'models/Database.php';
require_once 'models/newsletter_Subscribers.php';
$dbcon = Database::getDb();
$ns = new newsletter_Subscribers();
$email=$id = '';
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
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $selectedSubcriber= $ns->getSubscribersById($dbcon,$id);
    $email = $selectedSubcriber->email_id;
    $name = $selectedSubcriber->name;
}

$flag = 0;
if(isset($_POST['UpdateSubscriber']))
{
    $email = $_POST['email'];
    $name =$_POST['name'];
    if ($email == '')
    {
        $invalid = "Please enter the email address.";
        $flag =1;
    }
    else if (!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))
    {
        $invalid = "Please Enter valid Email Address.";
        $flag =1 ;
    }

    if($flag == 0)
    {

        $count = $ns->updateSubscribers($dbcon,$_POST['subscriberId'],$_POST['email'],$name);
        if($count)
        {
            header('Location:Admin-newsletter-subscribers.php');
        }
        else{
            header('Location:custom-error.php');
        }
    }
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/html" href="./css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
</head>
<body>
<?php include "header.php"; ?>

<section >
    <main class="page-container">
        <form action="" method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>Update News Letter Subscription Details</h2>
                </div>
                <input type="text" class="hidden" value="<?=$id?>" name="subscriberId">
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"  value="<?= isset($email)?$email:'';?>">
                    </div>
                    <div class="form-elements">
                        <label for="name">Full Name</label>
                        <input type="name" id="name" name="name"  value="<?= isset($name)?$name:'';?>">
                    </div>
                </div>

                <span class="error"><?= isset($invalid) ? $invalid: ''; ?></span>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="UpdateSubscriber" name="UpdateSubscriber">Update</button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </main>
</section>
<?= include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>


