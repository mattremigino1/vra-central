<?php
require("connect-db.php");
// include("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

require("central-db.php");
// include("friend-db.php");

$athlete_id = $_SESSION['athlete_id'];

$todayWorkout = getTodayWorkout();
$tmrrwWorkout = getTmrrwWorkout();
$eights = getEights();
$fours = getFours();
$twoman = getTwoMan();
$single = getSingle();
$name = getName($athlete_id); //for welcome message after logging in
$myLineup = myLineup($athlete_id);



?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Matt Remigino, Alex Becker, Maajid Husain, Yusuf Cetin">
  <meta name="description" content="Virginia Men's Rowing Central">

  <title>VRA Central</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />


</head>

<body>

  <?php

  include("header.html");

  ?>
  <div class="container">
    <br>
    <h3>
      <?php
      echo "Welcome ";
      echo $name[0];
      echo ". Your Athlete ID: ";
      echo $athlete_id;
      ?>
    </h3>
    <br>

    <div class="row justify-content-center">
      <h2>Today's Workouts</h2>
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th>Session</th>
            <th>Description</th>
          </tr>
        </thead>
        <?php foreach ($todayWorkout as $item): ?>
          <tr>
            <td>
              <?php
              if ($item['practice_num'] == 1) {
                echo "Morning";
              } else {
                echo "Afternoon";
              }
              ?>
            </td>
            <td>
              <?php echo $item['descr']; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <br>
    <div class="row justify-content-center">
      <h2>Tomorrow's Workouts</h2>
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th>Session</th>
            <th>Description</th>
          </tr>
        </thead>
        <?php foreach ($tmrrwWorkout as $item): ?>
          <tr>
            <td>
              <?php
              if ($item['practice_num'] == 1) {
                echo "Morning";
              } else {
                echo "Afternoon";
              }
              ?>
            </td>
            <td>
              <?php echo $item['descr']; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <br>
    <div class="row justify-content-center">
      <h2>Lineups</h2> </br>
      <div class="row justify-content-center">
        <h3>Your Boat and Seat: </h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
            <tr style="background-color:#B0B0B0">
              <th>Boat</th>
              <th>Seat</th>
            </tr>
          </thead>
          <td>
            <?php echo $myLineup[0]; ?>
          </td>
          <td>
            <?php echo $myLineup[1]; ?>
          </td>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Eights</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
            <tr style="background-color:#B0B0B0">
              <th>Boat</th>
              <th>Oars</th>
              <th>Rigging</th>
              <th>C</th>
              <th>S</th>
              <th>7</th>
              <th>6</th>
              <th>5</th>
              <th>4</th>
              <th>3</th>
              <th>2</th>
              <th>B</th>
            </tr>
          </thead>
          <?php foreach ($eights as $item): ?>
            <tr>
              <td>
                <?php echo $item['boat_name']; ?>
              </td>
              <td>
                <?php echo $item['oars']; ?>
              </td>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
              <td>
                <?php echo getName($item['coxswain'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['two_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['three_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['four_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['five_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['six_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['seven_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['eight_seat'])[0]; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Fours</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
            <tr style="background-color:#B0B0B0">
              <th>Boat</th>
              <th>Oars</th>
              <th>Rigging</th>
              <th>C</th>
              <th>S</th>
              <th>3</th>
              <th>2</th>
              <th>B</th>
            </tr>
          </thead>
          <?php foreach ($fours as $item): ?>
            <tr>
              <td>
                <?php echo $item['boat_name']; ?>
              </td>
              <td>
                <?php echo $item['oars']; ?>
              </td>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
              <td>
                <?php echo getName($item['coxswain'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['two_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['three_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['four_seat'])[0]; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Double/Pair</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
            <tr style="background-color:#B0B0B0">
              <th>Boat</th>
              <th>Oars</th>
              <th>Rigging</th>
              <th>S</th>
              <th>B</th>
            </tr>
          </thead>
          <?php foreach ($twoman as $item): ?>
            <tr>
              <td>
                <?php echo $item['boat_name']; ?>
              </td>
              <td>
                <?php echo $item['oars']; ?>
              </td>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <td>
                <?php echo getName($item['two_seat'])[0]; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Singles</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
            <tr style="background-color:#B0B0B0">
              <th>Boat</th>
              <th>Oars</th>
              <th>1</th>
            </tr>
          </thead>
          <?php foreach ($single as $item): ?>
            <tr>
              <td>
                <?php echo $item['boat_name']; ?>
              </td>
              <td>
                <?php echo $item['oars']; ?>
              </td>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>





  </div>
  <br> <br>
  <?php include('footer.html') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</body>

</html>