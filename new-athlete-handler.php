

<?php
require("connect-db.php");

$first_name = $last_name = $email = $phone = $dob = $grad_year = $height = $weight = $class = $boat_side = $two_kpr = $password = $pwd_confirm = NULL;
$first_name_msg = $last_name_msg = $email_msg = $phone_msg = $dob_msg = $grad_year_msg = $height_msg = $weight_msg = $class_msg = $boat_side_msg = $two_kpr_msg = $password_msg = $pwd_confirm_msg = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_POST['first_name'])) {
        $first_name_msg =  "Please enter your first name!";
    } else {
        $first_name = trim($_POST['first_name']);
    }
    if(empty($_POST['last_name'])) {
        $last_name_msg =  "Please enter your last name!";
    
    } else {
        $last_name = trim($_POST['last_name']);
    }
    if(empty($_POST['emailaddr'])) {
        $email_msg =  "Please enter your email!";
    } else {
        $email = trim($_POST['emailaddr']);
    }
    if(empty($_POST['phone'])) {
        $phone_msg = "Please enter your phone number!";

    } else {
        $phone = trim($_POST['phone']);
    }
    if(empty($_POST['dob'])) {
        $dob_msg = "Please enter your date of birth!";

    } else {
        $dob = trim($_POST['dob']);
    }
    if(empty($_POST['grad_year'])){
        $grad_year_msg =  "Please enter your graduation year!";

    } else {
        $grad_year = trim($_POST['grad_year']);
    }

    if(empty($_POST['height'])) {
        $height_msg = "Please enter your height!";

    } else {
        $height = trim($_POST['height']);
    }
    if(empty($_POST['weight'])) {
        $weight_msg = "Please enter your weight!";

    } else {
        $weight = trim($_POST['weight']);
    }
    if(empty($_POST['class'])) {
        $class_msg = "Please enter your class!";

    } else {
        $class = trim($_POST['class']);
    }
    if(empty($_POST['boat_side'])) {
        $boat_side_msg =  "Please enter your boat side!";

    } else {
        $boat_side = trim($_POST['boat_side']);
    }
    if(empty($_POST['2kpr'])) {
        $two_kpr_msg = "Please enter your 2k PR!";

    } else {
        $two_k_pr = trim($_POST['2kpr']);
    }
    if(empty($_POST['password'])) {
        $password_msg =  "Please enter your password!";

    } else {
        $password = trim($_POST['password']);
    }
    if(empty($_POST['password_confirm'])) {
        $pwd_confirm_msg = "Please confirm your password!";

    } else {
        $password_confirm = trim($_POST['password_confirm']);
    }
}
// check if there are any msg variables
if(!$first_name_msg || !$last_name_msg || !$email_msg || !$phone_msg || !$dob_msg || !$grad_year_msg || !$height_msg || !$weight_msg || !$class_msg || !$boat_side_msg || !$two_kpr_msg || !$password_msg || !$pwd_confirm_msg) {
    echo "Error messages: $first_name_msg <br/> $last_name_msg <br/> $email_msg <br/> $phone_msg <br/> $dob_msg <br/> $grad_year_msg <br/> $height_msg <br/> $weight_msg <br/> $class_msg <br/> $boat_side_msg <br/> $two_kpr_msg <br/> $password_msg <br/> $pwd_confirm_msg <br/>";
    header("Location: create_account.php");
}
// check if the passwords match
if ($password !== $password_confirm) {
    echo "Passwords do not match!";
    header("Location: create_account.php");;
}

// prepare and execute the insert statement
$sql = "INSERT INTO Athlete (first_name, last_name, email, phone_number, date_of_birth, grad_year, height, weight, class, boat_side, twoKPR)
        VALUES (:first_name, :last_name, :email, :phone, :dob, :grad_year, :height, :weight, :class, :boat_side, :two_k_pr)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':first_name' => $first_name,
    ':last_name' => $last_name,
    ':email' => $email,
    ':phone' => $phone,
    ':dob' => $dob,
    ':grad_year' => $grad_year,
    ':height' => $height,
    ':weight' => $weight,
    ':class' => $class,
    ':boat_side' => $boat_side,
    ':two_k_pr' => $two_k_pr,
]);




// hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert the hashed password into the passwords table
$sql = "INSERT INTO passwords (email, password) VALUES (:athlete_id, :password_hash)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashed_password);

if ($stmt->execute()) {
echo "New account created successfully!";
header("Location: login.php");
exit;
} else {
echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
exit;
}

// close the database connection
$pdo = null;
?>
