<?php
require("connect-db.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VRA Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css" />
</head>

<body class="page-body">

    <?php

    // include('header.html');
    
    if (isset($_GET['coach_id'])) {
        echo "New Account Created Succesfully! \n Your Coach ID is: ";
        echo $_GET['coach_id'];
        echo "    You need this to login, so make sure to write it down!";
    }

    ?>

    <div class="login-form-container">
        <h1 class='form-title'>VRA Coach Login</h1>
        <form action="login.php" method="post" class="login-form">
            <div class="form-group">
                <label>Coach ID: </label>
                <input type="text" class="form-control" name="coachID" autofocus required />
            </div>
            <div class="form-group">
                <label>Password: </label>
                <input type="password" class="form-control" name="pwd" autofocus required />
            </div>
            <input type="submit" class="login-btn btn btn-primary" value="Login" />
        </form>
    </div>

    <?php

    function authenticate()
    {
        global $db, $mainpage;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $coach_id = htmlspecialchars($_POST['coachID']);
            $password = htmlspecialchars($_POST['pwd']);

            // prepare a query to fetch the hashed password for the given username
            $sql = "SELECT psswrd FROM CoachPassword WHERE coach_id = :coach_id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':coach_id', $coach_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $hash = $row['psswrd'];

                // hash the password entered by the user
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                // compare the hashed password with the hash fetched from the database
                if (password_verify($password, $hash)) {
                    // successfully login, redirect the user to the main page
                    $_SESSION['loggedin'] = true;
                    $_SESSION['coach_id'] = $coach_id;
                    header("Location: " . $mainpage);
                } else {
                    echo "<span class='msg'>Coach ID and password do not match our record</span> <br/>";
                }
            } else {
                echo "<span class='msg'>Coach ID and password do not match our record</span> <br/>";
            }
        }
    }

    $mainpage = "coach-index.php";
    authenticate();

    ?>
    <?php include('footer.html') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

</body>

</html>