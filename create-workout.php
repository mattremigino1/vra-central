<?php
require("central-db.php");
require("connect-db.php");

session_start();


if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

$workout_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createDailyWorkoutBtn']) && $_POST['createDailyWorkoutBtn'] == "Create DailyWorkout") {
    $workout_created = createDailyWorkout(
      trim($_POST['descr'])
      );
  }
}
if ($workout_created) {
  header("Location:practices.php");
  die;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Workout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <div class="form-container">
    <h1>Create Workout</h1>

    <form action="create-workout.php" method="post" class="create-account-form">
      <div class="form-group">
        <label>Description: </label>
        <input type="text" class="form-control" name="descr" required />
      </div>
      <input type="submit" name="createDailyWorkoutBtn" value="Create DailyWorkout" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>