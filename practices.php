<?php
require("connect-db.php");

session_start();


if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

require("central-db.php");

$practices = get2WeeksPractices();

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

  <title>Practices</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  <link rel="stylesheet" href="main.css" />

</head>

<body class='page-body'>

  <?php
  include("Cheader.html");
  ?>

  <div class="container">
  <div class="row justify-content-center">
      <h2>Two Week Practice View</h2>
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th>Date</th>
            <th>Session</th>
            <th>Description</th>
          </tr>
        </thead>
        <?php foreach ($practices as $item): ?>
          <tr>
            <td>
                <?php echo $item['dte']?>
            </td>
            <td>
              <?php
              if ($item['practice_num'] == 1) {
                echo "Morning";
              } else {
                echo "Afternoon";
              }
              ?>
            </td>
            <td>
              <?php echo $item['descr']; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <br> <br>
  <?php include('footer.html') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</body>

</html>