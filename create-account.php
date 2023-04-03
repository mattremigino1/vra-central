<?php include("new-athlete-handler.php"); ?>

<?php include('footer.html') ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Example: PHP form handling</title>
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
   
    <form action="new_athlete_handler.php" method="post" onsubmit="return validateForm()">
      <label>First Name: </label>
      <input type="text" name="first_name" autofocus required /> <br/>
      <label>Last Name: </label>
      <input type="text" name="last_name" required /> <br/>
      <label>Email: </label>
      <input type="email" name="emailaddr" required /> <br/>
      <label>Phone Number: </label>
      <input type="tel" name="phone" required /> <br/>
      <label>Date of Birth: </label>
      <input type="date" name="dob" required /> <br/>
      <label>Graduation Year: </label>
      <input type="number" name="grad_year" required /> <br/>
      <label>Height: </label>
      <input type="number" name="height" required /> <br/>
      <label>Weight: </label>
      <input type="number" name="weight" required /> <br/>
      <label>Class: </label>
      <input type="text" name="class" required /> <br/>
      <label>Boat Side: </label>
      <input type="text" name="boat_side" required /> <br/>
      <label>2KPR: </label>
      <input type="number" name="2kpr" required /> <br/>
      <!-- set password and confirm password -->
      <label>Password: </label>
      <input type="password" name="pwd" required /> <br/>
      <label>Confirm Password: </label>
      <input type="password" name="pwd_confirm" required /> <br/>
      <input type="submit" value="Create Account" class="btn" />
      <!-- when the user clicks the button, the form data will be sent to form-handler.php -->
      <!-- the form data will be sent as a POST request -->
    </form>
    
    <div class="error-container"></div>
  </div>
 

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2Ml
