<?php
require_once 'models/Database.php';
require_once 'models/newsletter_Subscribers.php';
$dbcon = Database::getDb();
$flag = 0;
if(isset($_POST['subscribe']))
{
    $email = $_POST['email'];
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
        $s = new newsletter_Subscribers();
        $count = $s->addSubscriber($dbcon,$email);
        if($count)
        {
            header('Location:home.php');
        }
        else{
            header('Location:custom-error.php');
        }
    }
}
?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
</head>
<body>
<?php
include "header.php";
?>
<section >
    <main class="page-container">
        <form action="" method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>News Letter Subscription</h2>
                    <p>Want to Subscribe to News Letter for latest trends.</p>
                </div>

                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email"  value="<?= isset($email)?$email:'';?>">
                    </div>
                    <div class="form-elements">

                    </div>
                </div>

                <span class="error"><?= isset($invalid) ? $invalid: ''; ?></span>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="subscribe" name="subscribe">Subscribe</button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </main>
</section>

<?php
include "footer.php";
include "bootstrapjsfile.php"
?>

</body>

</html>
