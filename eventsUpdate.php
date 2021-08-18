<?php

require_once('Models/Database.php');
require_once ('Models/events.php');

$fname = $lname = $email = $pn = "";
$e = new events();
if(isset($_POST['eventsupdate'])){
    $id= $_POST['id'];

    $db = Database::getDb();
    $events = $e->getEventById($db,$id);

    $fname =  $events->first_name;
    $lname = $events->last_name;
    $email = $events->email;
    $pn = $events->phone_number;

}

if(isset($_POST['update_faq'])){
    $id= $_POST['eid'];
    $efname = $_POST['fname'];
    $elname = $_POST['lname'];
    $eemail = $_POST['email'];
    $epn = $_POST['pnumber'];

    $db = Database::getDb();
    $count = $e->updateEvent($db,$id, $efname, $elname,$eemail,$epn);
    if($count){
        header('Location: eventsAdmin.php');
    } else {
        echo "Problem occured!";
    }
}


?>
<html lang="en">
<head>
    <title>Events-Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/events.css">
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
            <div class="form">
                <input type="hidden" name="eid" value="<?= $id; ?>" />
            <div class="form-elements">
                <label for="fname">First Name :</label>
                <input type="text"  name="fname" id="fname" value="<?= $fname; ?>"
                   placeholder="Write First Name">

            </div>
            <div class="form-elements">
                <label for="lname">Last Name :</label>
                <input type="text"  name="lname" id="lname"  value="<?= $lname; ?>"
                   placeholder="Write Last Name">
            </div>
            <div class="form-elements">
                <label for="email">Email :</label>
                <input type="text" name="email" id="email"  value="<?= $email; ?>"
                   placeholder="Write Email">
            </div>
            <div class="form-elements">
                <label for="pnumber">Phone Number :</label>
                <input type="text"  name="pnumber" id="pnumber"  value="<?= $pn; ?>"
                   placeholder="Write Phone Number">
            </div>
            <div class="buttons">
                <button type="button" class="btn btn-warning"><a href="./eventsAdmin.php" id="back_button" class="form-elements float-left">Back</a></button>
                <button type="submit" name="update_faq"
                    class="btn btn-secondary float-right" id="btn-submit">Update Event</button>
            </div>
                
                 
            </div>
            
        </form>
    </div>
    
</div>

<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>