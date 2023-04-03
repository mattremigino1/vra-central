<?php 
require("new-athlete-handler.php"); 
require("connect-db.php");

$account_created = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['createAcctBtn']) && $_POST['createAcctBtn']=="Create Account")
  {
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
  header("Location:login.php?athlete_id=".$Message);
  die;
}

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Create Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link rel="stylesheet" href="activity-styles.css" /> 
</head>
<body>
  
  <?php include('header.html') ?>
  <div class="form-container">  
    <h1>Create Your VRA Account</h1>
   
    <!-- what are form inputs -->
    <!-- who will handle the form submission -->
    <!-- how are the request sent -->
   
    <form action="create-account.php" method="post">
      <label>First Name: </label>
      <input type="text" name="first_name" autofocus required /> <br/>
      <label>Last Name: </label>
      <input type="text" name="last_name" required /> <br/>
      <label>Email: </label><br/>
      <input type="email" name="emailaddr" required /> <br/>
      <label>Phone Number: </label>
      <input type="tel" name="phone" required /> <br/>
      <label>Date of Birth: </label>
      <input type="date" name="dob" required /> <br/>
      <label>Graduation Year: </label>
      <input type="number" name="grad_year" required /> <br/>
      <label>Height (in): </label> <br/>
      <input type="number" name="height" required /> <br/>
      <label>Weight (lbs): </label> <br/>
      <input type="number" name="weight" required /> <br/>
      <label>Class (1, 2, 3, 4): </label> <br/>
      <input type="text" name="class" required /> <br/>
      <label>Boat Side (S or P): </label>
      <input type="text" name="boat_side" required /> <br/>
      <label>2KPR Minutes: </label>
      <input type="number" name="2kprM" required /> <br/>
      <label>2KPR Seconds: </label>
      <input type="number" name="2kprS" required /> <br/>
      <!-- set password and confirm password -->
      <label>Password: </label>
      <input type="password" name="pwd" required /> <br/>
      <label>Confirm Password: </label>
      <input type="password" name="pwd_confirm" required /> <br/>
      <input type="submit" name="createAcctBtn" value="Create Account" class="btn btn-primary" />
      <!-- when the user clicks the button, the form data will be sent to form-handler.php -->
      <!-- the form data will be sent as a POST request -->
    </form>
    
    <div class="error-container"></div>
  </div>

  
 

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>

</html>