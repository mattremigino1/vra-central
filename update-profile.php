<?php
require("central-db.php");
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

$account_updated = False;

$athlete_id = $_SESSION['athlete_id'];
$current_info = getCurrentInfo($athlete_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['updateAcctBtn']) && $_POST['updateAcctBtn'] == "Update Profile") {
    $account_updated = updateAccount($athlete_id,
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
      trim($_POST['2kprS'])
    );
  }
}
if ($account_updated) {
  header("Location:view-account.php");
  die;
}

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css" />
</head>

<body>

  <div class="form-container">
    <h1>Update Your VRA Profile</h1>


    <form action="update-profile.php" method="post" class="create-account-form">
      <div class="form-group">
        <label for="fn">First Name: </label>
        <input type="text" class="form-control" value="<?php echo $current_info[1] ?>" name="first_name" id="fn" autofocus required />
      </div>
      <div class="form-group">
        <label>Last Name: </label>
        <input type="text" class="form-control" value="<?php echo $current_info[2] ?>" name="last_name" required />
      </div>
      <div class="form-group">
        <label>Email: </label>
        <input type="text" class="form-control" value="<?php echo $current_info[3] ?>" name="emailaddr" required />
      </div>
      <div class="form-group">
        <label>Phone Number: </label>
        <input type="tel" class="form-control" value="<?php echo $current_info[4] ?>" name="phone" required />
      </div>
      <div class="form-group">
        <label>Date of Birth: </label>
        <input type="date" class="form-control" value="<?php echo $current_info[5] ?>" name="dob" required />
      </div>
      <div class="form-group">
        <label>Graduation Year: </label>
        <input type="number" class="form-control" value="<?php echo $current_info[6] ?>" name="grad_year" required />
      </div>
      <div class="form-group">
        <label>Height (in): </label> <br />
        <input type="number" class="form-control" value="<?php echo $current_info[7] ?>" name="height" required />
      </div>
      <div class="form-group">
        <label>Weight (lbs): </label> <br />
        <input type="number" class="form-control" value="<?php echo $current_info[8] ?>" name="weight" required />
      </div>
      <div class="form-group">
        <label>Class: </label> <br />
        <select id="clss" name="class">
            <option value="<?php echo $current_info[9] ?>"><?php echo $current_info[9] ?></option>
            <option value="1">1st years</option>
            <option value="2">2nd years</option>
            <option value="3">3rd years</option>
            <option value="4">4th years</option>
          </select>
      </div>
      <div class="form-group">
        <label>Boat Side: </label>
        <select id="btside" name="boat_side">
            <option value="<?php echo $current_info[13] ?>"><?php echo $current_info[13] ?></option>
            <option value="S">Starboard</option>
            <option value="P">Port</option>
            <option value="S/P">Port/Starboard</option>
            <option value="S/P">Don't Know</option>
          </select>
      </div>
      <div class="form-group">
        <label>2KPR Minutes: </label>
        <input type="number" class="form-control" value="<?php echo floor($current_info[10]/60) ?>" name="2kprM" required />
      </div>
      <div class="form-group">
        <label>2KPR Seconds: </label>
        <input type="number" class="form-control" value="<?php echo $current_info[10]-(floor($current_info[10]/60))*60 ?>" name="2kprS" required />
      </div>
      <input type="submit" name="updateAcctBtn" value="Update Profile" class="btn btn-primary" />
    </form>
    <div class="error-container"></div>
  </div>



  <?php include('footer.html') ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>