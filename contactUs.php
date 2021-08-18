<?php
    require_once 'models/Database.php';
    require_once 'models/contactUsUsers.php';

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
    
    if (isset($_POST['submitMessage']))
    {
        $first_name = $_POST['fname'];
        $last_name =  $_POST['lname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $flag = 0;

        if($first_name == '')
        {
            $fnameErr = "Please Enter the first name!";
            $flag=1;
        }
        if($last_name == '')
        {
            $lnameErr = "Please Enter the last name!";
            $flag=1;
        }
        if($subject == '')
        {
            $subjectErr = "Please Enter the subject!";
            $flag=1;
        }
        if ($message == '')
        {
            $msgErr = "Please Enter the message!";
            $flag=1;
        }
        if( $email == '')
        {
            $emailErr = 'Please Enter the email!';
            $flag=1;
        }
        elseif(!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))
        {
            $emailErr ="Please Enter a valid Email Address";
            $flag=1;
        }
        if($flag == 0)
        {
            $dbcon = Database::getDb();
            $u = new contactUsUsers();
            $conn = $u->addMessage($dbcon,$first_name,$last_name,$email,$subject,$message);

            if($conn){
                header("Location: successContactUs.php");
            }
            else{
                echo "Problem occured!";
            }

        }
        
    }

?>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WebLancer-Home</title>
</head>
<body>
<?= include "header.php";?>

<section >
    <main class="page-container">
        <form action="" method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>Contact Us</h2>
                    <p>We will get back to you soon!</p>
                </div>
                <!-- <div class="form-element-wrapper"> -->
                    <div class="form-elements">
                        <label for="fname">First Name:</label>
                        <span class="error"><?= isset($fnameErr) ? $fnameErr: ''; ?></span>
                        <input type="text" id="fname" name="fname" placeholder="Enter First Name" value="<?= isset($first_name)?$first_name:'';?>">
                    </div>

                    <div class="form-elements">
                        <label for="lname">Last Name:</label>
                        <span class="error"><?= isset($lnameErr) ? $lnameErr: ''; ?></span>
                        <input type="text" id="lname" name="lname" placeholder="Enter Last Name" value="<?= isset($last_name)?$last_name:'';?>">
                    </div>
                
                    <div class="form-elements">
                        <label for="email">Email:</label>
                        <span class="error"><?= isset($emailErr) ? $emailErr: ''; ?></span>
                        <input type="email" id="email" name="email" placeholder="Enter Email" value="<?= isset($email)?$email:'';?>">
                    </div>
     
                    <div class="form-elements">
                        <label for="subject">Subject:</label>
                        <span class="error"><?= isset($subjectErr) ? $subjectErr: ''; ?></span>
                        <input type="text" id="subject" name="subject" placeholder="Enter subject" value="<?= isset($subject)?$subject:'';?>">
                    </div>
                
                <div class="individual-element">
                    <label for="message">Message:</label>
                    <span class="error"><?= isset($msgErr) ? $msgErr: ''; ?></span>
                    <textarea placeholder="Write your message ..." name="message" id="message" rows="5" >
                    <?= isset($message)?$message:'';?></textarea>
                </div>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="submit" name="submitMessage">Submit</button>
                </div>
            </div>
        </form>
    </main>
</section>
    <?= include "footer.php";
        include "bootstrapjsfile.php";
    ?>
</body>
</html>

