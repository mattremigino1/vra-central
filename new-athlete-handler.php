

<?php
require("connect-db.php");

function createAccount($first_name, $last_name, $email, $phone, $dob, $grad_year, $height, $ath_weight, $class, $boat_side, $two_kprM, $two_kprS, $password, $pwd_confirm) 
{ 
    echo "Hello";
    global $db;

    // get total 2k PR
    $two_k_pr = $two_kprM * 60 + $two_kprS;

// check if the passwords match
if ($password !== $pwd_confirm) {
    echo "Passwords do not match!";
    header("Location: create-account.php");;
}

// prepare and execute the insert statement
$query = "INSERT INTO Athlete (first_name, last_name, email, phone_number, date_of_birth, grad_year, height, ath_weight, class, boat_side, twoKPR)
        VALUES (:first_name, :last_name, :email, :phone, :dob, :grad_year, :height, :ath_weight, :class, :boat_side, :two_k_pr)";

$stmt = $db->prepare($query);

$stmt->bindValue(':first_name', $first_name);
$stmt->bindValue(':last_name', $last_name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':phone', $phone);
$stmt->bindValue(':dob', $dob);
$stmt->bindValue(':grad_year', $grad_year);
$stmt->bindValue(':height', $height);
$stmt->bindValue(':ath_weight', $ath_weight);
$stmt->bindValue(':class', $class);
$stmt->bindValue(':boat_side', $boat_side);
$stmt->bindValue(':two_k_pr', $two_k_pr);

$stmt->execute();

$stmt->closeCursor();

// get the new athlete ID
$sql = "SELECT MAX(athlete_id) FROM Athletes";
$stmt = $db->prepare($sql);
$stmt->execute();
$athlete_id = $stmt->fetch();
$stmt->closeCursor();

// hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert the hashed password into the passwords table
$sql = "INSERT INTO Passwords (athlete_id, password) VALUES (:athlete_id, :password_hash)";
$stmt = $db->prepare($sql);
$stmt->bindParam(':athlete_id', $athlete_id);
$stmt->bindParam(':password', $hashed_password);

if ($stmt->execute()) {
echo "New account created successfully! \n Your athleteID is: ";
echo $athlete_id;
echo "Make sure to write it down!";
} else {
echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
return False;
}
$stmt->closeCursor();

return True;

}

?>
