<?php
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
  <div class="page-container banner-text container">
    <h1 class="banner-heading">
      Join the work marketplace
    </h1>
    <h2>Find great talent. Build your bussiness.</br>Take your career to next level.</h2>
    <a href="sign-up.php" class="btn btn-primary">Join Now</a>
  </div>

  <div class="about">
    <h1>About us</h1>
    <p>All about us </p>
  </div>
  <div class="px-5 container">
    <h2>Freelancers</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
      <div class="col">
        <div class="card h-100">
          <img src="./images/avatar.jpg" height="250px" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Alex Smith</h5>
            <p class="card-text">Hi, I am a web developer work. I like to work on projects which are real time and use techinolgies like react and node.</p>
            <a href="freelancer-profile.php">View More</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="./images/avatar.jpg" height="250px" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Alex Smith</h5>
            <p class="card-text">Hi, I am a web developer work. I like to work on projects which are real time and use techinolgies like react and node.</p>
            <a href="freelancer-profile.php">View More</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100">
          <img src="./images/avatar.jpg" height="250px" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Alex Smith</h5>
            <p class="card-text">Hi, I am a web developer work. I like to work on projects which are real time and use techinolgies like react and node.</p>
            <a href="freelancer-profile.php">View More</a>
          </div>
        </div>
      </div>


    </div>
  </div>
  </div>
  <div class="about">
    <?php
    include "add-feedback.php";
    ?>
  </div>
  <?php
  include "footer.php";
  include "bootstrapjsfile.php"
  ?>

</body>

</html>