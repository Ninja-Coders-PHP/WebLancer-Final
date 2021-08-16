
<?php
    require_once 'models/Database.php';
    require_once 'models/users.php';
    require_once 'models/roles.php';
    require 'Library/form-functions.php';
    $dbcon = Database::getDb();
    $r = new roles();
    $u = new users();
    $roles = $r->getRoles($dbcon);
// $u->updateUser($dbcon,13,'manal','solanki','manal','1234567890','97manal@gmail.com','3');
$id=$fname=$lname=$email=$phn=$role_id=$username=$password= "";
    if(isset($_POST['updateUser']))
    {
        $id = $_POST['id'];
        $u = new users();
        $selectedUser = $u->getUserById($dbcon,$id);

        $fname = $selectedUser->first_name;
        $lname = $selectedUser->last_name;
        $username = $selectedUser->preferred_user_name;
        $phn = $selectedUser->phone_number;
        $email= $selectedUser->email;
        $role_id = $selectedUser->role_id;
        $password = $selectedUser->password;

    }

    if (isset($_POST['updateUserInfo']))
    {
        $id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $preferred_user_name = $_POST['preferred_user_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $phonePattern = "/[0-9]{10}/";
        $role = $_POST['role'];
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

        if($flag == 0)
        {
            $u = new users();
            $cnt = $u->updateUser($dbcon,$id,$first_name,$last_name,$preferred_user_name,$phone_number,$email,$role,$password);

            if($cnt)
            {
                    header("Location:Admin_Dashboard_listUser.php");

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
                    <input type="hidden" name="user_id" value="<?= $id; ?>"/>
                    <div class="form-elements">
                        <label for="name">First Name:</label>
                        <span class="error"><?= isset($fnameErr) ? $fnameErr: ''; ?></span>
                        <input type="text" id="first_name" name="first_name" placeholder="eg: Smith" value="<?= $fname;?>">
                    </div>

                    <div class="form-elements">
                        <label for="name">Last Name</label>
                        <span class="error"><?= isset($lnameErr) ? $lnameErr: ''; ?></span>
                        <input type="text" id="last_name" name="last_name" placeholder="eg: Johnson" value="<?= $lname;?>">
                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">Preferred User Name</label>
                        <input type="text" id="preferred_user_name" name="preferred_user_name" placeholder="eg: Smith" value="<?= $username;?>">
                    </div>
                    <div class="form-elements">
                        <label for="title">DropDown Label:</label>
                        <select id="role" name="role">
                            <?= populateDropdown($roles,$role_id); ?>
                        </select>
                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">Phone Number</label>
                        <span class="error"><?= isset($phnErr) ? $phnErr: ''; ?></span>
                        <input type="text" id="phone_number" name="phone_number" placeholder="eg: 1234567890" value="<?=$phn;?>">
                    </div>
                    <div class="form-elements">
                        <label for="name">Email</label>
                        <span class="error"><?= isset($emailErr) ? $emailErr: ''; ?></span>
                        <input type="email" id="email" name="email" placeholder="eg: example@gmail.com" value="<?=$email;?>">
                    </div>
                </div>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="addUser" name="updateUserInfo">Submit</button>
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

