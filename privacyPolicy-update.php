<?php
require_once 'models/Database.php';
require_once 'models/privacypolicy.php';
$dbcon = Database::getDb();
session_start();
$pp = new privacypolicy();
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
$flag = 0;
$id =$name=$description=$modifiedDate=$createdDate=$user_id = "";
if(isset($_POST['updatePolicy']))
{
    $id = $_POST['id'];
    $selectedPolicy = $pp->getPolicyById($dbcon,$id);
    $name = $selectedPolicy->name;
    $description = $selectedPolicy->description;
    $user_id = $selectedPolicy->user_id;
    $createdDate = $selectedPolicy->created_date;
    $modifiedDate =  $selectedPolicy->modified_date;

}
if(isset($_POST['updateDetails']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $user_id = $_SESSION['userid'];
    $createdDate = $_POST['created_date'];
    $modifiedDate =  date("Y-m-d H:i:s");
    if ($name == '')
    {
        $invalid = "Please enter the policy name";
        $flag =1;
    }

    if($description == '')
    {
        $invalid = "Please enter description.";
        $flag =1;
    }
    elseif ($description == "Enter the details of Policy")
    {
        $invalid = "Please enter valid description.";
        $flag =1;
    }

    if($flag == 0)
    {


        $count = $pp->updatePolicy($dbcon,$id,$name,$description,$createdDate,$modifiedDate,$user_id);
        if($count)
        {
            header('Location:privacyPolicy-list.php');
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
                    <h2>New Privacy Policy</h2>
                </div>
                <input class="hidden" type="text" value="<?=$id?>" name="id"/>
                <input  class="hidden"  type="text" value="<?=$user_id?>" name="user_id">
                <input  class="hidden"  type="text" value="<?=$createdDate?>" name="created_date"/>

                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="name">Policy Name</label>
                        <input type="text" id="name" name="name"  value="<?= isset($name)?$name:'';?>">
                    </div>

                </div>
                <div class="form-element-wrapper">
                    <div class="form-elements">
                        <label for="description">Policy Details</label>
                        <textarea cols="10" rows="5" id="description" name="description" placeholder="Enter the details of Policy"> <?= isset($description)? htmlspecialchars($description):'Enter the details of Policy';?></textarea>
                    </div>
                </div>

                <span class="error"><?= isset($invalid) ? $invalid: ''; ?></span>
                <div class="submit-section">
                    <button class="submit-Button" type="submit" id="update" name="updateDetails">Update</button>
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


