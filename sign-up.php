<?php
    require_once 'models/Database.php';
    require_once 'models/users.php';
    require_once 'models/roles.php';
    require './Library/form-functions.php';
    $dbcon = Database::getDb();
    $r = new roles();
    $roles = $r->getRoles($dbcon);

// Form validation
/*
    All the fields are  present.
    Checking with regular expression for phone number and email address.
 */
    if (isset($_POST['addUser']))
    {
        $first_name = $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $preferred_user_name = $_POST['preferred_user_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $phonePattern = "/[0-9]{10}/";
        $role = $_POST['role'];
        $password =$_POST['password'];
        $confPassword = $_POST['confPassword'];
        $flag = 0;
        if($first_name == '')
        {
            $fnameErr = "Please Enter the first name";
            $flag=1;
        }
        if($last_name == '')
        {
            $lnameErr = "Please Enter the last name";
            $flag=1;
        }
        if($preferred_user_name == '')
        {
            $preferred_user_name = $first_name ;
        }
        if ($phone_number == '')
        {
            $phnErr = "Please Enter a phone number.";
            $flag=1;
        }
        else if(!preg_match($phonePattern,$phone_number)) {
            $phnErr = "Please Enter a valid phone number.";
            $flag=1;
        }
        if( $email == '')
        {
            $emailErr = 'Please Enter a email Address';
            $flag=1;
        }
        elseif(!filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))
        {
            $emailErr ="Please Enter a valid Email Address";
            $flag=1;
        }
        if($password == '')
        {
            $passwordErr = "Please Enter a Password.";
            $flag = 1;
        }
        if($confPassword == '')
        {
            $confPasswordErr = "Please Enter the Password again.";
            $flag = 1;
        }
        else if (strcmp($password,$confPassword))
        {
            $confPasswordErr ="Please enter the same password.";
            $flag = 1;
        }
        if($flag == 0)
        {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $u = new users();
            $cnt = $u->addUsers($dbcon,$first_name,$last_name,$preferred_user_name,$phone_number,$email,$role,$hashedPassword);
            if($cnt)
            {
                    header("Location:login.php");
            }
            else
            {
                header("Location:custom-error.php");
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
<?php
include "header.php";
?>
<section >
    <main class="page-container">
        <form action="" method="POST">
            <div class="form">
                <div class="form-heading">
                    <h2>Sign Up</h2>
                    <p>Please create an account to join us.</p>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">First Name:</label>
                        <span class="error"><?= isset($fnameErr) ? $fnameErr: ''; ?></span>
                        <input type="text" id="first_name" name="first_name" placeholder="eg: Smith" value="<?= isset($first_name)?$first_name:'';?>">
                    </div>

                    <div class="form-elements">
                        <label for="name">Last Name</label>
                        <span class="error"><?= isset($lnameErr) ? $lnameErr: ''; ?></span>
                        <input type="text" id="last_name" name="last_name" placeholder="eg: Johnson" value="<?= isset($last_name)?$last_name:'';?>">
                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">Preferred User Name</label>
                        <input type="text" id="preferred_user_name" name="preferred_user_name" placeholder="eg: Smith" value="<?= isset($preferred_user_name)?$preferred_user_name:'';?>">
                    </div>
                    <div class="form-elements">
                        <label for="title">DropDown Label:</label>
                        <select id="role" name="role">
                            <?= populateDropdown($roles); ?>
                        </select>
                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="phone_number">Phone Number</label>
                        <span class="error"><?= isset($phnErr) ? $phnErr: ''; ?></span>
                        <input type="text" id="phone_number" name="phone_number" placeholder="eg: 1234567890" value="<?= isset($phone_number)?$phone_number:'';?>">
                    </div>
                    <div class="form-elements">
                        <label for="email">Email</label>
                        <span class="error"><?= isset($emailErr) ? $emailErr: ''; ?></span>
                        <input type="email" id="email" name="email" placeholder="eg: example@gmail.com" value="<?= isset($email)?$email:'';?>">
                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">Password</label>
                        <span class="error"><?= isset($passwordErr) ? $passwordErr: ''; ?></span>
                        <input type="password" id="password" name="password" placeholder="eg: " value="<?= isset($password)?$password:'';?>">
                    </div>
                    <div class="form-elements">
                        <label for="confPassword">Confirm Password</label>
                        <span class="error"><?= isset($confPasswordErr) ? $confPasswordErr: ''; ?></span>
                        <input type="password" id="confPassword" name="confPassword" placeholder="eg: " value="<?= isset($confPassword)?$confPassword:'';?>">
                    </div>
                </div>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="addUser" name="addUser">Submit</button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </main>
</section>
<?php
include "footer.php";
include "bootstrapjsfile.php";
?>

</body>

</html>