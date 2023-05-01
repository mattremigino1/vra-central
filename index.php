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
    <div class="title-wrapper">
      <h1 class="page-title">
        Welcome,
        <?php
        echo $name[0];
        ?>
      </h1>
      <span class='welcome-subtitle'>
        (ID:
        <?php
        echo $athlete_id;
        ?>
        )
      </span>
    </div>
    <div>
      <h3>You're <span class="dynamic-item">
          <?php echo $myLineup[1]; ?> seat
        </span> of the <span class="dynamic-item">
          <?php echo $myLineup[0]; ?>
        </span> </h3>
    </div>
    <div class="workouts-section">
      <div class="row justify-content-center">
        <h2>Today's Workouts</h2>
        <table class="table">
          <thead>
            <tr>
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

      <div class="row justify-content-center">
        <h2>Tomorrow's Workouts</h2>
        <table class="table">
          <thead>
            <tr>
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
    </div>
    <div class="lineups-section row justify-content-center">
      <div class="row justify-content-center">
        <h3>Eights</h3>
        <table class="table table-hover table-bordered table-sm">
          <tr>
            <th>Boat</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <b>
                  <?php echo $item['boat_name']; ?>
                </b>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Oars</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo $item['oars']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Rigging</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Bow</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>2</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['two_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>3</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['three_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>4</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['four_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>5</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['five_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>6</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['six_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>7</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['seven_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Stroke</th>
            <?php foreach ($eights as $item): ?>
              <td>
                <?php echo getName($item['eight_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Cox</th>
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
        <table class="table table-hover table-bordered table-sm">
          <tr>
            <th>Boat</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <b>
                  <?php echo $item['boat_name']; ?>
                </b>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Oars</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo $item['oars']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Rigging</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Bow</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>2</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo getName($item['two_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>3</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo getName($item['three_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Stroke</th>
            <?php foreach ($fours as $item): ?>
              <td>
                <?php echo getName($item['four_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Cox</th>
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
        <table class="table table-hover table-bordered table-sm">
          <tr>
            <th>Boat</th>
            <?php foreach ($twoman as $item): ?>
              <td>
                <b>
                  <?php echo $item['boat_name']; ?>
                </b>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Oars</th>
            <?php foreach ($twoman as $item): ?>
              <td>
                <?php echo $item['oars']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Rigging</th>
            <?php foreach ($twoman as $item): ?>
              <td>
                <?php echo $item['rigging']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Bow</th>
            <?php foreach ($twoman as $item): ?>
              <td>
                <?php echo getName($item['one_seat'])[0]; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Stroke</th>
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
        <table class="table table-hover table-bordered table-sm">
          <tr>
            <th>Boat</th>
            <?php foreach ($single as $item): ?>
              <td>
                <b>
                  <?php echo $item['boat_name']; ?>
                </b>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>Oars</th>
            <?php foreach ($single as $item): ?>
              <td>
                <?php echo $item['oars']; ?>
              </td>
            <?php endforeach; ?>
          </tr>
          <tr>
            <th>1</th>
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