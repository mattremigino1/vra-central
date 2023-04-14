<?php
require("connect-db.php"); 
// include("connect-db.php");
session_start();

//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//} else {
//  header("Location: login.php");
//}

require("athlete-directory-handler.php");
$athletes = selectAllAthletes();

if (isset($_POST['submit'])) {
    $search_name = $_POST['search_name'];
    $athletes = getAthleteByName($search_name);
  } else if (!empty($_POST['deleteAthlete']) && ($_POST['deleteAthlete'] == "Remove Athlete"))
  {
    deleteAthlete($_POST['athlete_id']);
    $friends = selectAllFriends();
  } else {
    $athletes = selectAllAthletes();
  }

?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>VRA Central Athlete Directory</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />

       
</head>

<body>

<?php include("header.html") ?>

<!-- Add form to POST to athlete-directory.php and filter by name -->

<div class="container">
  <form action="coach-athlete-directory.php" method="post">
    <div class="row justify-content-center">
      <div class="col-4">
        <input type="text" class="form-control" name="search_name" placeholder="Search by First Name">
      </div>
      <div class="col-2">
        <input type="submit" class="btn btn-primary" name="submit" value="Search">
      </div>
    </div>
  </form>

<div class="container">
  <h1>Athlete Directory</h1>  
  <div class="row justify-content-center">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <div class="container">
          <thead>
          <tr style="background-color:#B0B0B0">
            <th>Athlete ID</th>
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
             <td><?php echo $item['athlete_id']; ?></td>
             <td><?php echo $item['first_name']; ?></td>        
             <td><?php echo $item['last_name']; ?></td>  
             <td><?php echo $item['email']; ?></td>
             <td><?php echo $item['phone_number']; ?></td>
             <td><?php echo $item['dob']; ?></td>
             <td><?php echo $item['grad_year']; ?></td>
             <td><?php echo $item['height']; ?></td>
             <td><?php echo $item['athletic_weight']; ?></td>
             <td><?php echo $item['class']; ?></td>
             <td><?php echo $item['boat_side']; ?></td>
             <td><?php echo $item['2k_pr']; ?></td>
             <td><?php echo $item['g8']; ?></td>
             <td><?php echo $item['age']; ?></td>            
            <td>
            <form action="coach-athlete-directory.php" method="post">
                <input type="submit" class="btn btn-danger" name="deleteAthlete" value="Remove Athlete">
                <input type="hidden" name="athlete_id" value="<?php echo $item['athlete_id']; ?>">
            </form>
            </td>
            </tr>
        <?php endforeach; ?>
        </table>
  </div>   








</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
  
</body>

</html>