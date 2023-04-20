<?php
require("connect-db.php");
require("central-db.php");

session_start();

if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

$coach_id = $_SESSION['coach_id'];


$boats = getBoats();
$displayedBoat = "";
$seats = "";
$boatInfo = "";
$lineup = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['selectBoat']) && $_POST['selectBoat'] == "View Boat") {
      $lineup = getBoatLineup($_POST['boat']);
      $boatInfo = getBoatInfo($_POST['boat']);
      $seats = $boatInfo[0]['num_seats'];
      $displayedBoat = $boatInfo[0]['Name'];
    }
    // if (!empty($_POST['deleteBtn']) && $_POST['deleteBtn'] == "Delete") {
    //     deleteWorkout($_POST['delete_athid'], $_POST['delete_workoutNum']);
    //     $workouts = getExtraWorkouts($_POST['delete_athid']);
    //     $displayedAthlete = getName($_POST['delete_athid'])[0];
    //     $totalMins = getTotalMins($_POST['delete_athid'])[0];
    //     $displayedAthleteID = $_POST['delete_athid'];
    //   }
}
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

  <title>Make Lineups</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="main.css" />

</head>

<body class='page-body'>

  <?php
  include("Cheader.html");
  ?>

  <div class="container">
    <div class="row justify-content-center">
    <form action="make-lineups.php" method="post">
      <label><b>Boat:</b></label>
      <select name="boat" class='form-control'>
      <option value="">--- Select ---</option>
      <?php foreach ($boats as $item): ?>
        <option value="<?php echo $item['Name']; ?>">
            <?php echo $item['Name']; ?>
        </option>
      <?php endforeach; ?>
      </select>
      <input class="btn btn-primary" name="selectBoat" type="submit" value="View Boat" />
    </form>
    
    <div class="row justify-content-center">
        <?php if ($displayedBoat == ""): ?>
        <h3>Please select a boat</h3>
        <?php else: ?>
       <h3><?php echo $displayedBoat ?></h3>
       <?php if ($seats == "8"): ?>
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <tr>
            <th style="background-color:#B0B0B0">B</th>
            <td><?php echo getName($lineup[4])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">2</th>
            <td><?php echo getName($lineup[5])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">3</th>
            <td><?php echo getName($lineup[6])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">4</th>
            <td><?php echo getName($lineup[7])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">5</th>
            <td><?php echo getName($lineup[8])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">6</th>
            <td><?php echo getName($lineup[9])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">7</th>
            <td><?php echo getName($lineup[10])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">S</th>
            <td><?php echo getName($lineup[11])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">C</th>
            <td><?php echo getName($lineup[3])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Oars</th>
            <td><?php echo $lineup[1] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Rig</th>
            <td><?php echo $lineup[2] ?></td>
            <td></td>
          </tr>
      </table>
      <?php elseif ($seats == "4"): ?>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <tr>
            <th style="background-color:#B0B0B0">B</th>
            <td><?php echo getName($lineup[4])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">2</th>
            <td><?php echo getName($lineup[5])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">3</th>
            <td><?php echo getName($lineup[6])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">S</th>
            <td><?php echo getName($lineup[7])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">C</th>
            <td><?php echo getName($lineup[3])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Oars</th>
            <td><?php echo $lineup[1] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Rig</th>
            <td><?php echo $lineup[2] ?></td>
            <td></td>
          </tr>
        </table>
      <?php elseif ($seats == "2"): ?>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <tr>
            <th style="background-color:#B0B0B0">B</th>
            <td><?php echo getName($lineup[3])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">S</th>
            <td><?php echo getName($lineup[4])[0] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Oars</th>
            <td><?php echo $lineup[1] ?></td>
            <td></td>
          </tr>
          <tr>
            <th style="background-color:#B0B0B0">Rig</th>
            <td><?php echo $lineup[2] ?></td>
            <td></td>
          </tr>
        </table>
      <?php else: ?>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <tr>
            <th style="background-color:#B0B0B0">1</th>
            <td><?php echo getName($lineup[2])[0] ?></td>
            <td></td>
          </tr>
            <th style="background-color:#B0B0B0">Oars</th>
            <td><?php echo $lineup[1] ?></td>
            <td></td>
          </tr>
        </table>

      <?php endif; ?>

      <?php endif; ?>
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