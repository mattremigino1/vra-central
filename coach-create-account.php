<?php
require("coach-handler.php");
require("connect-db.php");

$account_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['createAcctBtn']) && $_POST['createAcctBtn'] == "Create Account") {
    $account_created = createAccount(
      trim($_POST['first_name']),
      trim($_POST['last_name']),
      trim($_POST['emailaddr']),
      trim($_POST['phone']),
      trim($_POST['position']),
      trim($_POST['pwd']),
      trim($_POST['pwd_confirm'])
    );
    $coacb_id = getCoachID();
  }
}
if ($account_created) {
  $Message = urlencode($coach_id);
  header("Location:coach-login.php?coach_id=" . $Message);
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
        <label>Phone Number: </label>
        <input type="tel" class="form-control" name="phone" required />
      </div>
      <div class="form-group">
        <label>Position: </label>
        <input type="text" class="form-control" name="position" required />
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