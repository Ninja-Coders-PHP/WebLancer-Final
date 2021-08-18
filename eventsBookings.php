<?php
    require_once 'models/Database.php';
    require_once 'models/events.php';
    
    if (isset($_POST['submitBooking']))
    {
        $first_name = $_POST['fname'];
        $last_name =  $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['pnumber'];
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
        if($phone == '')
        {
            $pnumber = "Please Enter the phone number!";
            $flag=1;
        }
       
        if( $email == '')
        {
            $emailErr = 'Please Enter the email!';
            $flag=1;
        }
        
        if($flag == 0)
        {
            $dbcon = Database::getDb();
            $e = new events();
            $conn = $e->addEvent($dbcon,$first_name,$last_name,$email,$phone);

            if($conn){
                header("Location: successContactUs.php");
            }
            else{
                echo "Problem occured!";
            }

        }
        
    }

?>
<html>
   <head>
      <title>Events - Registration</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" type="text/css" href="./css/global.css">
      <link rel="stylesheet" type="text/css" href="./css/events.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
      <?php
         include "header.php";
         ?>
      <div class="wrapper-bookings">
         <!-- form for events bookings -->
         <form action="" method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>Start your registration</h2>
                    <p>see you soon,<strong>Virtually!</strong></p>
                </div>
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
                        <label for="pnumber">Phone Number:</label>
                        <span class="error"><?= isset($phnErr) ? $phnErr: ''; ?></span>
                        <input type="text" id="pnumber" name="pnumber" placeholder="Enter Number" value="<?= isset($subject)?$subject:'';?>">
                    </div>
                
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="submitBooking" name="submitBooking">Submit</button>
                </div>
            </div>
        </form>
      </div>
      <?= include_once "footer.php";
         include_once "bootstrapjsfile.php";
         ?>
   </body>
</html>