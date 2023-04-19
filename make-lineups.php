<?php
require("connect-db.php");
require("central-db.php");

session_start();

if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

$athlete_id = 1;
$coach_id = $_SESSION['coach_id'];
$name = getName($athlete_id); 
$workouts = getExtraWorkouts($athlete_id);

$displayedAthleteID = $athlete_id;
$totalMins = getTotalMins($athlete_id)[0];

$boats = getBoats();
$displayedBoat = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['selectAthlete']) && $_POST['selectAthlete'] == "View Athlete") {
      $workouts = getExtraWorkouts($_POST['athlete']);
      $displayedAthlete = getName($_POST['athlete'])[0];
      $totalMins = getTotalMins($_POST['athlete'])[0];
      $displayedAthleteID = $_POST['athlete'];
    }
    if (!empty($_POST['deleteBtn']) && $_POST['deleteBtn'] == "Delete") {
        deleteWorkout($_POST['delete_athid'], $_POST['delete_workoutNum']);
        $workouts = getExtraWorkouts($_POST['delete_athid']);
        $displayedAthlete = getName($_POST['delete_athid'])[0];
        $totalMins = getTotalMins($_POST['delete_athid'])[0];
        $displayedAthleteID = $_POST['delete_athid'];
      }
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
        <option name="name" value="<?php echo $item['Name']; ?>">
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
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <tr style="background-color:#B0B0B0">
            <th>B</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>2</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>3</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>4</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>5</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>6</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>7</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>S</th>
            <td></td>
            <td></td>
          </tr>
          <tr style="background-color:#B0B0B0">
            <th>C</th>
            <td></td>
            <td></td>
          </tr>
        <?php foreach ($workouts as $item): ?>
          <tr>
            <td>
              <?php echo $item['dte']; ?>
            </td>
            <td>
              <?php echo $item['mins']; ?>
            </td>
            <td>
              <?php echo $item['workout_type']; ?>
            </td>
            <td>
              <?php echo $item['descr']; ?>
            </td>
            <?php if ($athlete_id == $displayedAthleteID): ?>
            <td>
              <form action="extra-work.php" method="post">
                <input type="submit" name="deleteBtn" value="Delete" class="btn btn-danger" />
                <input type="hidden" name="delete_athid" 
                       value="<?php echo $item['athlete_id']; ?>"  />
                <input type="hidden" name="delete_workoutNum" 
                       value="<?php echo $item['workout_num']; ?>"  />       
              </form> 
             </td>
             <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
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