<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">   
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>VRA Login</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link rel="stylesheet" href="activity-styles.css" /> 
</head>
<body>
  
  <?php include('header.html') ?>
  
  <div>  
    <h1>PHP: Form Handling</h1>
    <form action="login.php" method="post">     
      Username: <input type="text" name="name" required /> <br/>
      Password: <input type="password" name="pwd" required /> <br/>
      <input type="submit" value="Submit" class="btn" />
    </form>
    <input type="button" value="Create Account" onclick="location.href='create_account.php';">
 
    <?php

$dbhost = 'localhost';
$dbname = 'central';
$dbuser = 'me';
$dbpass = '1234';


try {
    // connect to the database using PDO
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e) {
    // display an error message if the connection fails
    echo "Failed to connect to the database: " . $e->getMessage();
    exit;
}

function authenticate()
{
    global $db, $mainpage;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['pwd']);

        // prepare a query to fetch the hashed password for the given username
        $stmt = $db->prepare("SELECT password FROM Passwords WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $hash = $row['password'];

            // hash the password entered by the user
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // compare the hashed password with the hash fetched from the database
            if (password_verify($password, $hash)) {
                // successfully login, redirect the user to the main page
                header("Location: " . $mainpage);
            } else {
                echo "<span class='msg'>Username and password do not match our record</span> <br/>";
            }
        } else {
            echo "<span class='msg'>Username and password do not match our record</span> <br/>";
        }
    }
}

$mainpage = "index.php";
authenticate();

?>
    </div>
<?php include('footer.html') ?>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>

