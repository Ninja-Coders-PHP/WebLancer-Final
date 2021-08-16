<?php
?>
<html lang="en">
<link rel="stylesheet" type="text/css" href="./css/global.css">
<link rel="stylesheet" type="text/css" href="./css/DisputeManagement.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title>WebLancer - Dispute Management</title>
<?php
include "header.php";
?>
<body>
<main class="container" >
    <h1>Dispute Management Center</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary me-md-2" type="button">Open New Dispute</button>

    </div>

    <table class="table table-success table-striped">
        <tr>
            <th>Dispute ID</th>
            <th>Status</th>
            <th>Category</th>
            <th>Project ID</th>
            <th>Last Message</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Open</td>
            <td>Website Fee</td>
            <td>1</td>
            <td>Thank you for reaching out, will continue further communication after the long weekend.</td>
        </tr>
        <tr>
            <td>2</td>
            <td>In-progress</td>
            <td>failed time-line/Uncompleted Job</td>
            <td>2</td>
            <td>Please send us a transcript of your last communication with this employee.</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Completed</td>
            <td>low quality of work</td>
            <td>3</td>
            <td>What are the employee credential? when you let us know then we can decide regard this dispute.</td>
        </tr>
    </table>
    <div class="container">
        <img src="images/w.jpg"" alt="istockphoto" style="width:100%;">
        <p>Hello. How are you today?</p>
        <span class="time-right">11:00</span>
    </div>

    <div class="container darker">
        <img src="images/user123.jpg" alt="unsplash" class="right" style="width:100%;">
        <p>Hey! I'm fine. Thanks for asking!</p>
        <span class="time-left">11:01</span>
    </div>

    <div class="container">
        <img src="images/w.jpg"" alt="istockphoto" style="width:100%;">
        <p>What can I help you today?</p>
        <span class="time-right">11:02</span>
    </div>

    <div class="container darker">
        <img src="images/user123.jpg" alt="unsplash" class="right" style="width:100%;">
        <p>I would like to get a status regarding Dispute ID #1 , thank you.</p>
        <span class="time-left">11:05</span>
    </div>




</main>
<?php
include "footer.php";
include "bootstrapjsfile.php";
?>
</body>
</html>
