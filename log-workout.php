<?php
require("new-workout-handler.php");
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

$athlete_id = $_SESSION['athlete_id'];

$workout_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createWrktoutBtn']) && $_POST['createWrktoutBtn'] == "Create Workout") {
    $workout_created = createWorkout(
      $athlete_id,
      trim($_POST['workout_num']),
      trim($_POST['mins']),
      trim($_POST['dte']),
      trim($_POST['workout_type']),
      trim($_POST['descr'])
      );
  }
}
if ($workout_created) {
  header("Location:extra-work.php");
  die;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log Workout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <!-- <?php include('header.html') ?> -->
  <div class="form-container">
    <h1>Log Your Workout</h1>

    <!-- what are form inputs -->
    <!-- who will handle the form submission -->
    <!-- how are the request sent -->

    <form action="log-workout.php" method="post" class="create-account-form">
      <div class="form-group">
        <label for="fn">Which extra work session was this for you today?: </label>
          <select id="wrktnum" name="workout_num">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
      </div>
      <div class="form-group">
        <label>Minutes: </label>
        <input type="number" class="form-control" name="mins" required />
      </div>
      <div class="form-group">
        <label>Date: </label>
        <input type="date" class="form-control" name="dte" required />
      </div>
      <div class="form-group">
        <label>Workout Type: </label>
        <select id="wrktype" name="workout_type">
            <option value="Erg">Erg</option>
            <option value="Bike">Bike</option>
            <option value="SEAL">SEAL</option>
            <option value="Trophy">Trophy</option>
            <option value="Heavy Metal">Heavy Metal</option>
            <option value="PEL">PEL</option>
            <option value="Small Boats">Small Boats</option>
            <option value="Other">Other</option>
          </select>
      </div>
      <div class="form-group">
        <label>Description: </label> <br />
        <input type="text" class="form-control" name="descr" required />
      </div>
      <input type="submit" name="createWrktoutBtn" value="Create Workout" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>