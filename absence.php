<?php
require("central-db.php");
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

$athlete_id = $_SESSION['athlete_id'];

$absence_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createAbsenceBtn']) && $_POST['createAbsenceBtn'] == "Create Absence") {
    $absence_created = createAbsence(
      $athlete_id,
      trim($_POST['practice_num']),
      trim($_POST['dte'])
      );
  }
}
if ($absence_created) {
  header("Location:view-absences.php");
  die;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log Absence</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <!-- <?php include('header.html') ?> -->
  <div class="form-container">
    <h1>Log Your Absence</h1>

    <form action="absence.php" method="post" class="create-account-form">
      <div class="form-group">
        <label for="fn">Which practice session will you be absent from?: </label>
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
      <input type="submit" name="createAbsenceBtn" value="Create Absence" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>