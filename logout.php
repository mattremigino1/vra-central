<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if(isset($_POST['logoutbutton'])) {
    unset($_SESSION['loggedin']);
    unset($_SESSION['athlete_id']);
    session_destroy();
    
    header('location:login.php');
  }
}
?>