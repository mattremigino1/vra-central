<?php
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

require("central-db.php");

$athlete_id = $_SESSION['athlete_id'];
$name = getName($athlete_id); 
$workouts = getExtraWorkouts($athlete_id);
$athletes = getAthletes();
$displayedAthlete = $name[0];
$displayedAthleteID = $athlete_id;
$totalMins = getTotalMins($athlete_id)[0];

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

  <title>Extra Work</title>

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
    <div class="row justify-content-center">
    <form action="extra-work.php" method="post">
      <label><b>Athlete:</b></label>
      <select name="athlete" class='form-control'>
      <option value="">--- Select ---</option>
      <?php foreach ($athletes as $item): ?>
        <option name="name" value="<?php echo $item['athlete_id']; ?>">
            <?php echo $item['Name']; ?>
        </option>
      <?php endforeach; ?>
      </select>
      <input class="btn btn-primary" name="selectAthlete" type="submit" value="View Athlete" />
    </form>
    
    <div class="row justify-content-center">
       <h3>Workouts for <?php echo $displayedAthlete ?></h3>
       <h5>Total Minutes: <?php echo $totalMins ?></h5>
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th>Date</th>
            <th>Minutes</th>
            <th>Type</th>
            <th>Description</th>
            <?php if ($athlete_id == $displayedAthleteID): ?>
            <th>Delete?</th>
            <?php endif; ?>
          </tr>
        </thead>
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