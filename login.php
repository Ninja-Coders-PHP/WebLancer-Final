<?php
require_once 'models/Database.php';
require_once 'models/users.php';
require_once 'models/roles.php';
require './Library/form-functions.php';
$dbcon = Database::getDb();
$u = new users();
session_start();
// Form validation
/*
    All the fields are  present.
    Checking with regular expression for phone number and email address.
 */
if (isset($_POST['login']))
{
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if($userName == '' || $password == '')
    {
        $invalid = "Please Enter username and Password";
    }
    else
    {
        $selectUser =  $u->getUserByUserName($dbcon,$userName);
       if($selectUser->preferred_user_name == $userName && password_verify($password,$selectUser->password))
       {
           $_SESSION['username'] = $selectUser->preferred_user_name ;
           $_SESSION['userid'] = $selectUser ->id;
           $_SESSION['role']= $selectUser->role_name;
           if($_SESSION['role'] == "Freelancer")
           {
               header("Location:freelancer-profile.php ");
           }
           else if ($_SESSION['role'] == "Employer")
           {
               header("Location:employer-profile.php");
           }
           else
           {
               header('Location:Admin-Dashboard.php');
           }
       }
       else
       {
           $invalid ="Invalid Credentials";
       }

    }

//    if($flag == 0)
//    {
//        $u = new users();
//        $cnt = $u->addUsers($dbcon,$first_name,$last_name,$preferred_user_name,$phone_number,$email,$role);
//        if($cnt)
//        {
//            if($role == 3)
//            {
//                header("Location:freelancer-profile.php ");
//            }
//            else if ($role == 4)
//            {
//                header("Location:employer-profile.php");
//            }
//            else
//            {
//                header("Location:custom-error.php");
//            }
//
//        }
//    }
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
                    <h2>Login </h2>
                    <p>Please login in here</p>
                </div>

                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="userName">User Name</label>
                        <input type="text" id="userName" name="userName"  value="<?= isset($userName)?$userName:'';?>">
                    </div>
                    <div class="form-elements">

                    </div>
                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="password">Password</label>

                        <input type="password" id="password" name="password"  value="<?= isset($password)?$password:'';?>">
                    </div>
                </div>
                <span class="error"><?= isset($invalid) ? $invalid: ''; ?></span>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="login" name="login">Login</button>
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