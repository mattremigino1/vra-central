<?php
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

require("central-db.php");

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="main.css" />

</head>

<body class='page-body'>

  <?php

  include("header.html");

  ?>
  <div class="container">
    <br>
    <h1>
      <?php
      echo "Welcome ";
      echo $name[0];
      ?>
    </h1>
    <h4>
      <?php
      echo "Athlete ID: ";
      echo $athlete_id;
      ?>
    </h4>
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
            <tr>
              <th style="background-color:#B0B0B0">Boat</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <b><?php echo $item['boat_name']; ?></b>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo $item['oars']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rigging</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo $item['rigging']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Bow</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">2</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['two_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">3</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['three_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">4</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['four_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">5</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['five_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">6</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['six_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">7</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['seven_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Stroke</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['eight_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Cox</th>
              <?php foreach ($eights as $item): ?>
              <td>
              <?php echo getName($item['coxswain'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Fours</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
            <tr>
              <th style="background-color:#B0B0B0">Boat</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <b><?php echo $item['boat_name']; ?></b>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo $item['oars']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rigging</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo $item['rigging']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Bow</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">2</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo getName($item['two_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">3</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo getName($item['three_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Stroke</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo getName($item['four_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Cox</th>
              <?php foreach ($fours as $item): ?>
              <td>
              <?php echo getName($item['coxswain'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
        </table>   
      </div>
      <div class="row justify-content-center">
        <h3>Doubles/Pairs</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
            <tr>
              <th style="background-color:#B0B0B0">Boat</th>
              <?php foreach ($twoman as $item): ?>
              <td>
              <b><?php echo $item['boat_name']; ?></b>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <?php foreach ($twoman as $item): ?>
              <td>
              <?php echo $item['oars']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rigging</th>
              <?php foreach ($twoman as $item): ?>
              <td>
              <?php echo $item['rigging']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Bow</th>
              <?php foreach ($twoman as $item): ?>
              <td>
              <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Stroke</th>
              <?php foreach ($twoman as $item): ?>
              <td>
              <?php echo getName($item['two_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
        </table>
      </div>
      <div class="row justify-content-center">
        <h3>Singles</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
            <tr>
              <th style="background-color:#B0B0B0">Boat</th>
              <?php foreach ($single as $item): ?>
              <td>
              <b><?php echo $item['boat_name']; ?></b>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <?php foreach ($single as $item): ?>
              <td>
              <?php echo $item['oars']; ?>
              </td>
              <?php endforeach; ?>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">1</th>
              <?php foreach ($single as $item): ?>
              <td>
              <?php echo getName($item['one_seat'])[0]; ?>
              </td>
              <?php endforeach; ?>
            </tr>
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