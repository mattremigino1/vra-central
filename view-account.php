<?php
require("connect-db.php");

session_start();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
} else {
  header("Location: login.php");
}

require("central-db.php");

$athlete_id = $_SESSION['athlete_id'];

$current_info = getCurrentInfo($athlete_id);
$name = getName($athlete_id);
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

  <title>View Profile</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="main.css" />

</head>

<body class='page-body'>

  <?php include("header.html"); ?>
  <div class="container">
    <br>
    <h1>
      <?php
      echo "Welcome ";
      echo $name[0];
      ?>
    </h1>
    <h4>
      <?php
      echo "Athlete ID: ";
      echo $athlete_id;
      ?>
    </h4>
    <br>

    <div class="row justify-content-center">
      <div class="row justify-content-center">
        <h3>Profile</h3>
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
            <tr>
              <th style="background-color:#B0B0B0">Name</th>
              <td>
              <?php echo $current_info[1]; echo " "; echo $current_info[2]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Email</th>
              <td>
              <?php echo $current_info[3]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Phone Number</th>
              <td>
              <?php echo $current_info[4];?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Date of Birth</th>
              <td>
              <?php echo $current_info[5];?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Grad Year</th>
              <td>
              <?php echo $current_info[6]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Height (inches)</th>
              <td>
              <?php echo $current_info[7]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Weight</th>
              <td>
              <?php echo $current_info[8]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Class</th>
              <td>
              <?php echo $current_info[9]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">2k PR</th>
              <td>
              <?php echo floor($current_info[10]/60); echo ":"; echo $current_info[10]-(floor($current_info[10]/60))*60; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">G8</th>
              <td>
              <?php echo $current_info[11]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Age</th>
              <td>
              <?php echo $current_info[12]; ?>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Boat Side</th>
              <td>
              <?php echo $current_info[13]; ?>
              </td>
            </tr>
        </table>
      </div>
    </div>



</body>
<?php include('footer.html') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</html>