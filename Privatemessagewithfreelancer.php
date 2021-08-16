<?php
?>
<html lang="en">
<script type="text/javascript" src="./js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="./js/Privatemessagewithfreelancer.js"></script>
<link rel="stylesheet" type="text/css" href="./css/global.css">
<link rel="stylesheet" type="text/css" href="css/Privatemessagewithfreelancer.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
<title>WebLancer - Private Message Your Employees</title>
<body>
<?php
include "header.php";
?>
<main>
<h1>Private Message Your Employees</h1>

<h2>Choose a project to view the associated employees: </h2>

    <dl>
        <dt>Project ID # 1</dt>
        <dd>Send a private message to: <span class="employeeName">Manal Solansky</span>.</dd>
        <dt>Project ID # 2</dt>
        <dd>Send a private message to: <span class="employeeName">Haroon Shaffi</span> or <span class="employeeName">Majdi</span>.</dd>
        <dt>Project ID # 3</dt>
        <dd>Send a private message to: <span class="employeeName">Uditesh Jha</span>.</dd>
    </dl>

    <!--- to display after user print the answers--->
    <section id="toDisplay">
        <p>Sending private message to <span id="employeeName"></span><p>
    </section>
</main>
<?php
include "footer.php";
?>
</body>
</html>

