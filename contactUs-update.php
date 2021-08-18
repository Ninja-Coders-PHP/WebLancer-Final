<?php
    require_once 'models/Database.php';
    require_once 'models/contactUsUsers.php';


    $fname=$lname=$email=$subject=$message= "";
    $u = new contactUsUsers();
    if(isset($_POST['updateMsgDetail']))
    {
        $id = $_POST['id'];
        $dbcon = Database::getDb();
        $selectedContact = $u->getMessageById($dbcon,$id);

        $fname = $selectedContact->first_name;
        $lname = $selectedContact->last_name;
        $email= $selectedContact->email;
        $subject = $selectedContact->subject;
        $message = $selectedContact->message;

    }
    if (isset($_POST['updateMessage']))
    {
        $uid = $_POST['userid'];
        $first_name = $_POST['fname'];
        $last_name =  $_POST['lname'];
        $uemail = $_POST['email'];
        $usubject = $_POST['subject'];
        $umessage = $_POST['message'];
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
        if($usubject == '')
        {
            $subjectErr = "Please Enter the subject!";
            $flag=1;
        }
        if($umessage == '')
        {
            $msgErr = "Please Enter the message!";
            $flag=1;
        }
        if($uemail == '')
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
            $conn = $u->updateMessage($dbcon,$uid,$first_name,$last_name,$uemail,$usubject,$umessage);

            if($conn){
                header("Location: Admin_Dashboard_ContactUs.php");
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
                    <h2>Contact Us - Form</h2>
                    <p>Update details!</p>
                </div>
                <!-- <div class="form-element-wrapper"> -->
                    <input type="hidden" name="userid" value="<?= $id; ?>"/>
                    <div class="form-elements">
                        <label for="fname">First Name:</label>
                        <span class="error"><?= isset($fnameErr) ? $fnameErr: ''; ?></span>
                        <input type="text" id="fname" name="fname" placeholder="Enter First Name" value="<?=$fname;?>">
                    </div>

                    <div class="form-elements">
                        <label for="lname">Last Name:</label>
                        <span class="error"><?= isset($lnameErr) ? $lnameErr: ''; ?></span>
                        <input type="text" id="lname" name="lname" placeholder="Enter Last Name" value="<?=$lname;?>">
                    </div>
                
                    <div class="form-elements">
                        <label for="email">Email:</label>
                        <span class="error"><?= isset($emailErr) ? $emailErr: ''; ?></span>
                        <input type="email" id="email" name="email" placeholder="Enter Email" value="<?= $email;?>">
                    </div>
     
                    <div class="form-elements">
                        <label for="subject">Subject:</label>
                        <span class="error"><?= isset($subjectErr) ? $subjectErr: ''; ?></span>
                        <input type="text" id="subject" name="subject" placeholder="Enter subject" value="<?=$subject;?>">
                    </div>
                
                <div class="individual-element">
                    <label for="message">Message:</label>
                    <span class="error"><?= isset($msgErr) ? $msgErr: ''; ?></span>
                    <textarea name="message" id="message" rows="5">
                    <?= $message;?></textarea>
                </div>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="updateMessage" name="updateMessage">Update</button>
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

