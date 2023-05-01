<?php
require("connect-db.php");
// include("connect-db.php");
session_start();

if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) || isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

require("athlete-directory-handler.php");
$athletes = selectAllAthletes();

require("central-db.php");
$all_athletes = getAthletes();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['selectAthlete']) && $_POST['selectAthlete'] == "View Athlete") {
    $search_name = $_POST['athlete'];
    $athletes = getAthleteByName($search_name);
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
  <meta name="description" content="include some description about your page">

  <title>VRA Central Athlete Directory</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="main.css" />
</head>

<body>
  <div class="page-body">
    <?php include("header.html") ?>

    <!-- Add form to POST to athlete-directory.php and filter by name -->

    <div class="container">
      <h1 class="page-title">Athlete Directory</h1>
      <form action="athlete-directory.php" method="post" class="athlete-directory-form">
        <select name="athlete" class='form-control'>
          <option value="">-- Select --</option>
          <?php foreach ($all_athletes as $item): ?>
            <option name="name" value="<?php echo $item['athlete_id']; ?>">
              <?php echo $item['Name']; ?>
            </option>
          <?php endforeach; ?>
        </select>
        <input class="btn btn-primary" name="selectAthlete" type="submit" value="View Athlete" />
      </form>

      <table class="table table-hover table-striped table-sm athlete-directory-table">
        <thead>
          <tr class="athlete-directory-tr">
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
            <th>Grad Year</th>
            <th>Height</th>
            <th>Athletic Weight</th>
            <th>Class</th>
            <th>Boat Side</th>
            <th>2K PR</th>
            <th>G8</th>
            <th>Age</th>
          </tr>
        </thead>
        <?php foreach ($athletes as $item): ?>
          <tr>
            <td>
              <?php echo $item['athlete_id']; ?>
            </td>
            <td>
              <?php echo $item['first_name']; ?>
            </td>
            <td>
              <?php echo $item['last_name']; ?>
            </td>
            <td>
              <?php echo $item['email']; ?>
            </td>
            <td>
              <?php echo $item['phone_number']; ?>
            </td>
            <td>
              <?php echo $item['date_of_birth']; ?>
            </td>
            <td>
              <?php echo $item['grad_year']; ?>
            </td>
            <td>
              <?php echo $item['height']; ?>
            </td>
            <td>
              <?php echo $item['ath_weight']; ?>
            </td>
            <td>
              <?php echo $item['class']; ?>
            </td>
            <td>
              <?php echo $item['boat_side']; ?>
            </td>
            <td>
              <?php echo $item['twoKPR']; ?>
            </td>
            <td>
              <?php echo $item['g8']; ?>
            </td>
            <td>
              <?php echo $item['age']; ?>
            </td>
          </tr>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>

</body>
</html>