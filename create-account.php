<?php
require("new-athlete-handler.php");
require("connect-db.php");

$account_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createAcctBtn']) && $_POST['createAcctBtn'] == "Create Account") {
    $account_created = createAccount(
      trim($_POST['first_name']),
      trim($_POST['last_name']),
      trim($_POST['emailaddr']),
      trim($_POST['phone']),
      trim($_POST['dob']),
      trim($_POST['grad_year']),
      trim($_POST['height']),
      trim($_POST['weight']),
      trim($_POST['class']),
      trim($_POST['boat_side']),
      trim($_POST['2kprM']),
      trim($_POST['2kprS']),
      trim($_POST['pwd']),
      trim($_POST['pwd_confirm'])
    );
    $athlete_id = getAthID();
  }
}
if ($account_created) {
  $Message = urlencode($athlete_id);
  header("Location:login.php?athlete_id=" . $Message);
  die;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <!-- <?php include('header.html') ?> -->
  <div class="form-container">
    <h1>Create Your VRA Account</h1>

    <!-- what are form inputs -->
    <!-- who will handle the form submission -->
    <!-- how are the request sent -->

    <form action="create-account.php" method="post" class="create-account-form">
      <div class="form-group">
        <label for="fn">First Name: </label>
        <input type="text" class="form-control" name="first_name" id="fn" autofocus required />
      </div>
      <div class="form-group">
        <label>Last Name: </label>
        <input type="text" class="form-control" name="last_name" required />
      </div>
      <div class="form-group">
        <label>Email: </label>
        <input type="text" class="form-control" name="emailaddr" required />
      </div>
      <div class="form-group">
        <label>Phone Number: </label>
        <input type="tel" class="form-control" name="phone" required />
      </div>
      <div class="form-group">
        <label>Date of Birth: </label>
        <input type="date" class="form-control" name="dob" required />
      </div>
      <div class="form-group">
        <label>Graduation Year: </label>
        <input type="number" class="form-control" name="grad_year" required />
      </div>
      <div class="form-group">
        <label>Height (in): </label> <br />
        <input type="number" class="form-control" name="height" required />
      </div>
      <div class="form-group">
        <label>Weight (lbs): </label> <br />
        <input type="number" class="form-control" name="weight" required />
      </div>
      <div class="form-group">
        <label>Class: </label> <br />
        <select id="clss" name="class">
            <option value="1">1st years</option>
            <option value="2">2nd years</option>
            <option value="3">3rd years</option>
            <option value="4">4th years</option>
          </select>
      </div>
      <div class="form-group">
        <label>Boat Side: </label>
        <select id="btside" name="boat_side">
            <option value="S">Starboard</option>
            <option value="P">Port</option>
            <option value="P">Don't Know</option>
          </select>
      </div>
      <div class="form-group">
        <label>2KPR Minutes: </label>
        <input type="number" class="form-control" name="2kprM" required />
      </div>
      <div class="form-group">
        <label>2KPR Seconds: </label>
        <input type="number" class="form-control" name="2kprS" required />
      </div>
      <div class="form-group">
        <label>Password: </label>
        <input type="password" class="form-control" name="pwd" required />
      </div>
      <div class="form-group">
        <label>Confirm Password: </label>
        <input type="password" class="form-control" name="pwd_confirm" required />
      </div>
      <input type="submit" name="createAcctBtn" value="Create Account" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>