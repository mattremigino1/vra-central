<?php
require("central-db.php");
require("connect-db.php");

session_start();


if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

$practice_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createPracticeBtn']) && $_POST['createPracticeBtn'] == "Create Practice") {
    $practice_created = createPractice(
      trim($_POST['practice_num']),
      trim($_POST['dte']),
      trim($_POST['workout_id'])
      );
  }
}
if ($practice_created) {
  header("Location:practices.php");
  die;
}

$workouts = getWorkouts();

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Practice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <div class="form-container">
    <h1>Create Practice</h1>

    <form action="create-practice.php" method="post" class="create-account-form">
      <div class="form-group">
        <label for="fn">Practice session (for the day): </label>
          <select id="prctnum" name="practice_num">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
      </div>
      <div class="form-group">
        <label>Date: </label>
        <input type="date" class="form-control" name="dte" required />
      </div>
      <div class="form-group">
        <label>Workout: </label>
        <select id="wrktype" name="workout_id">
            <?php foreach ($workouts as $item): ?>
                <option value="<?php echo $item['workout_id']; ?>">
                    <?php echo $item['descr']; ?>
                </option>
            <?php endforeach; ?>
        </select>
      </div>
      <input type="submit" name="createPracticeBtn" value="Create Practice" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>