<?php
require("connect-db.php");
require("central-db.php");

session_start();

if (isset($_SESSION['Cloggedin']) && $_SESSION['Cloggedin'] == true) {
} else {
  header("Location: login.php");
}

$coach_id = $_SESSION['coach_id'];


$boats = getBoats();
$displayedBoat = "";
$seats = "";
$boatInfo = "";
$lineup = "";
$athletes = getAthletes();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['selectBoat']) && $_POST['selectBoat'] == "View Boat") {
    $lineup = getBoatLineup($_POST['boat']);
    $boatInfo = getBoatInfo($_POST['boat']);
    $seats = $boatInfo[0]['num_seats'];
    $displayedBoat = $boatInfo[0]['Name'];
  }
  if (!empty($_POST['lineup8']) && $_POST['lineup8'] == "Finalize Lineup") {
    $boatInfo = getBoatInfo($_POST['theBoat']);
    $seats = $boatInfo[0]['num_seats'];
    $displayedBoat = $boatInfo[0]['Name'];
    createEightLineup($displayedBoat, $_POST['cox'], $_POST['stroke'], $_POST['seven'], $_POST['six'], $_POST['five'], $_POST['four'], $_POST['three'], $_POST['two'], $_POST['bow'], $_POST['oars'], $_POST['rig']);
    $lineup = getBoatLineup($_POST['theBoat']);
    echo "Lineup Finalized";
  }
  if (!empty($_POST['lineup4']) && $_POST['lineup4'] == "Finalize Lineup") {
    $boatInfo = getBoatInfo($_POST['theBoat']);
    $seats = $boatInfo[0]['num_seats'];
    $displayedBoat = $boatInfo[0]['Name'];
    createFourLineup($displayedBoat, $_POST['cox'], $_POST['stroke'], $_POST['three'], $_POST['two'], $_POST['bow'], $_POST['oars'], $_POST['rig']);
    $lineup = getBoatLineup($_POST['theBoat']);
    echo "Lineup Finalized";
  }
  if (!empty($_POST['lineup2']) && $_POST['lineup2'] == "Finalize Lineup") {
    $boatInfo = getBoatInfo($_POST['theBoat']);
    $seats = $boatInfo[0]['num_seats'];
    $displayedBoat = $boatInfo[0]['Name'];
    createTwoLineup($displayedBoat, $_POST['stroke'], $_POST['bow'], $_POST['oars'], $_POST['rig']);
    $lineup = getBoatLineup($_POST['theBoat']);
    echo "Lineup Finalized";
  }
  if (!empty($_POST['lineup1']) && $_POST['lineup1'] == "Finalize Lineup") {
    $boatInfo = getBoatInfo($_POST['theBoat']);
    $seats = $boatInfo[0]['num_seats'];
    $displayedBoat = $boatInfo[0]['Name'];
    createSingleLineup($displayedBoat, $_POST['stroke'], $_POST['oars']);
    $lineup = getBoatLineup($_POST['theBoat']);
    echo "Lineup Finalized";
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
  <meta name="description" content="Virginia Men's Rowing Central">

  <title>Make Lineups</title>

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
    <h2 class="page-title">Create Lineups</h2>
    <form action="make-lineups.php" method="post" class="filter-form-container">
      <select name="boat" class='form-control'>
        <option value="">--- Select boat ---</option>
        <?php foreach ($boats as $item): ?>
          <option value="<?php echo $item['Name']; ?>">
            <?php echo $item['Name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input class="btn btn-primary" name="selectBoat" type="submit" value="View Boat" />
    </form>

    <div class="row justify-content-center">
      <?php if ($displayedBoat == ""): ?>
        <h3>Select a boat above</h3>
      <?php else: ?>
        <h3 class="boat-title-name" style="width: 60%; text-align: center; margin-top: 64px">
          <?php echo $displayedBoat ?>
        </h3>
        <?php if ($seats == "8"): ?>
          <table class="center" style="width: 60%">
            <tr>
              <th style="background-color:#B0B0B0">B</th>
              <td>
                <form id="lineup-form8" action="make-lineups.php" method="post">
                  <select name="bow" class='form-control'>
                    <option value="<?php echo $lineup[3] ?>"><?php echo getName($lineup[3])[0] ?></option>
                    <?php foreach ($athletes as $item): ?>
                      <option value="<?php echo $item['athlete_id']; ?>">
                        <?php echo $item['Name']; ?>
                      </option>
                    <?php endforeach; ?>
                    <option value="NULL">--</option>
                  </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">2</th>
              <td>
                <select name="two" class='form-control'>
                  <option value="<?php echo $lineup[4] ?>"><?php echo getName($lineup[4])[0]; ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">3</th>
              <td>
                <select name="three" class='form-control'>
                  <option value="<?php echo $lineup[5] ?>"><?php echo getName($lineup[5])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">4</th>
              <td>
                <select name="four" class='form-control'>
                  <option value="<?php echo $lineup[6] ?>"><?php echo getName($lineup[6])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">5</th>
              <td>
                <select name="five" class='form-control'>
                  <option value="<?php echo $lineup[7] ?>"><?php echo getName($lineup[7])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">6</th>
              <td>
                <select name="six" class='form-control'>
                  <option value="<?php echo $lineup[8] ?>"><?php echo getName($lineup[8])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">7</th>
              <td>
                <select name="seven" class='form-control'>
                  <option value="<?php echo $lineup[9] ?>"><?php echo getName($lineup[9])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">S</th>
              <td>
                <select name="stroke" class='form-control'>
                  <option value="<?php echo $lineup[10] ?>"><?php echo getName($lineup[10])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">C</th>
              <td>
                <select name="cox" class='form-control'>
                  <option value="<?php echo $lineup[2] ?>"><?php echo getName($lineup[2])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <td>
                <input value="<?php echo $lineup[1] ?>" type="text" class="form-control" name="oars" required />
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rig</th>
              <td>
                <input value="<?php echo $lineup[11] ?>" type="text" class="form-control" name="rig" required />
                <input value="<?php echo $displayedBoat ?>" type="hidden" name="theBoat" />
                <input value="<?php echo $seats ?>" type="hidden" name="seatNumber" />
                </form>
              </td>
            </tr>
          </table>
          <input class="btn btn-primary" type="submit" value="Finalize Lineup" name="lineup8" form="lineup-form8"
            style="width: 60%;"></input>
        <?php elseif ($seats == "4"): ?>
          <table class="w3-table w3-bordered w3-card-4 center" style="width: 60%;">
            <tr>
              <th style="background-color:#B0B0B0">B</th>
              <td>
                <form id="lineup-form4" action="make-lineups.php" method="post">
                  <select name="bow" class='form-control'>
                    <option value="<?php echo $lineup[3] ?>"><?php echo getName($lineup[3])[0] ?></option>
                    <?php foreach ($athletes as $item): ?>
                      <option value="<?php echo $item['athlete_id']; ?>">
                        <?php echo $item['Name']; ?>
                      </option>
                    <?php endforeach; ?>
                    <option value="NULL">--</option>
                  </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">2</th>
              <td>
                <select name="two" class='form-control'>
                  <option value="<?php echo $lineup[4] ?>"><?php echo getName($lineup[4])[0]; ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">3</th>
              <td>
                <select name="three" class='form-control'>
                  <option value="<?php echo $lineup[5] ?>"><?php echo getName($lineup[5])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">S</th>
              <td>
                <select name="stroke" class='form-control'>
                  <option value="<?php echo $lineup[6] ?>"><?php echo getName($lineup[6])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">C</th>
              <td>
                <select name="cox" class='form-control'>
                  <option value="<?php echo $lineup[2] ?>"><?php echo getName($lineup[2])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <td>
                <input value="<?php echo $lineup[1] ?>" type="text" class="form-control" name="oars" required />
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rig</th>
              <td>
                <input value="<?php echo $lineup[7] ?>" type="text" class="form-control" name="rig" required />
                <input value="<?php echo $displayedBoat ?>" type="hidden" name="theBoat" />
                <input value="<?php echo $seats ?>" type="hidden" name="seatNumber" />
                </form>
              </td>
            </tr>
          </table>
          <input class="btn btn-primary" type="submit" value="Finalize Lineup" name="lineup4" form="lineup-form4"
            style="width: 60%;"></input>
        <?php elseif ($seats == "2"): ?>
          <table class="w3-table w3-bordered w3-card-4 center" style="width: 60%;">
            <tr>
              <th style="background-color:#B0B0B0">B</th>
              <td>
                <form id="lineup-form2" action="make-lineups.php" method="post">
                  <select name="bow" class='form-control'>
                    <option value="<?php echo $lineup[2] ?>"><?php echo getName($lineup[2])[0] ?></option>
                    <?php foreach ($athletes as $item): ?>
                      <option value="<?php echo $item['athlete_id']; ?>">
                        <?php echo $item['Name']; ?>
                      </option>
                    <?php endforeach; ?>
                    <option value="NULL">--</option>
                  </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">S</th>
              <td>
                <select name="stroke" class='form-control'>
                  <option value="<?php echo $lineup[3] ?>"><?php echo getName($lineup[3])[0] ?></option>
                  <?php foreach ($athletes as $item): ?>
                    <option value="<?php echo $item['athlete_id']; ?>">
                      <?php echo $item['Name']; ?>
                    </option>
                  <?php endforeach; ?>
                  <option value="NULL">--</option>
                </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <td>
                <input value="<?php echo $lineup[1] ?>" type="text" class="form-control" name="oars" required />
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Rig</th>
              <td>
                <input value="<?php echo $lineup[4] ?>" type="text" class="form-control" name="rig" required />
                <input value="<?php echo $displayedBoat ?>" type="hidden" name="theBoat" />
                <input value="<?php echo $seats ?>" type="hidden" name="seatNumber" />
                </form>
              </td>
            </tr>
          </table>
          <input class="btn btn-primary" type="submit" value="Finalize Lineup" name="lineup2" form="lineup-form2"
            style="width: 60%;"></input>
        <?php else: ?>
          <table class="w3-table w3-bordered w3-card-4 center" style="width: 60%;">
            <tr>
              <th style="background-color:#B0B0B0">S</th>
              <td>
                <form id="lineup-form1" action="make-lineups.php" method="post">
                  <select name="stroke" class='form-control'>
                    <option value="<?php echo $lineup[2] ?>"><?php echo getName($lineup[2])[0] ?></option>
                    <?php foreach ($athletes as $item): ?>
                      <option value="<?php echo $item['athlete_id']; ?>">
                        <?php echo $item['Name']; ?>
                      </option>
                    <?php endforeach; ?>
                    <option value="NULL">--</option>
                  </select>
              </td>
            </tr>
            <tr>
              <th style="background-color:#B0B0B0">Oars</th>
              <td>
                <input value="<?php echo $lineup[1] ?>" type="text" class="form-control" name="oars" required />
                <input value="<?php echo $displayedBoat ?>" type="hidden" name="theBoat" />
                <input value="<?php echo $seats ?>" type="hidden" name="seatNumber" />
              </td>
            </tr>
          </table>
          <input class="btn btn-primary" type="submit" value="Finalize Lineup" name="lineup1" form="lineup-form1"
            style="width: 60%;"></input>
        <?php endif; ?>

      <?php endif; ?>
    </div>

  </div>





  </div>
  <br> <br>
  <?php include('footer.html') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

</body>

</html>