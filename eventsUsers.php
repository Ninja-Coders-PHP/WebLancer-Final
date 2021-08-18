<html>
   <head>
      <title>Events</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" type="text/css" href="./css/global.css">
      <link rel="stylesheet" type="text/css" href="./css/events.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="js/eventsUsers.js" charset="utf-8"></script>  
    </head>
   <body>
      <?php
         include "header.php";
         ?>
      <div class="wrapper-container">
         <!-- first event card. -->
         <div class="column-1">
            <div class="card">
               <p class="card-title">Hackathon</p>
               <div class="card-desc">
                  <img class="card-icons" src="images/calendar.png" alt="calendar icon">
                  <p class="card-day">5 NOV 2021</p>
                  <img class="card-icons" src="images/clock.png" alt="clock icon">
                  <p class="card-time">7 AM - 11 PM</p>
               </div>
               <p>Welcome folks to our hackathonday! You can work on your projects individually or in the 
                   group of maximun 4 people. You can work on any lanuage, any framework or we can say on any projects! Winner will receive $1000!
               </p>
               <button class="card-btn" type="button" name="button"><span>Book Now</span></button>
            </div>
         </div>
         <!-- second event card. -->
         <div class="column-2">
            <div class="card">
               
               <p class="card-title">Coding challenge!</p>
               <div class="card-desc">
                  <img class="card-icons" src="images/calendar.png" alt="calendar icon">
                  <p class="card-day">2 DEC 2021</p>
                  <img class="card-icons" src="images/clock.png" alt="clock icon">
                  <p class="card-time">3 PM - 10 PM</p>
               </div>
               <p>Here we are pleased to announce that we are going to organize biggest coding challenge
                   of Ontario. You have to complete given tasks in the given time. You can choose any programming language. Hurry up and 
                   register for this event. Winner will earn $2000!
               </p>
               <button class="card-btn" type="button" name="button"><span>Book Now</span></button>
            </div>
         </div>
         
      </div>
      <?= include_once "footer.php";
         include_once "bootstrapjsfile.php";
         ?>
   </body>
</html>