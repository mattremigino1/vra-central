<?php

function getCoachID() {
    global $db;
    // get the new athlete ID
    $sql = "SELECT MAX(coach_id) FROM Coach";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $coach_id = ($stmt->fetch())[0];
    $stmt->closeCursor();

    return $coach_id;
}

function createAccount($first_name, $last_name, $email, $phone, $position) 
{ 
    global $db;

// prepare and execute the insert statement
$query = "INSERT INTO Coach (first_name, last_name, email, phone_number, position)
        VALUES (:first_name, :last_name, :email, :phone, :position)";

$stmt = $db->prepare($query);

$stmt->bindValue(':first_name', $first_name);
$stmt->bindValue(':last_name', $last_name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':phone', $phone);
$stmt->bindValue(':position', $position);

$stmt->execute();

$stmt->closeCursor();

// get the new coach ID
$sql = "SELECT MAX(coach_id) FROM Coach";
$stmt = $db->prepare($sql);
$stmt->execute();
$coach_id = ($stmt->fetch())[0];
$stmt->closeCursor();

// hash the password
$password = "VRACoachPassword1234";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert the hashed password into the passwords table
$sql = "INSERT INTO CoachPasswords (coach_id, psswrd) VALUES (:coach_id, :password_hash)";
$stmt = $db->prepare($sql);
$stmt->bindValue(':coach_id', $coach_id);
$stmt->bindValue(':password_hash', $hashed_password);

if ($stmt->execute()) {
echo "New account created successfully! \n Your coachID is: ";
echo $coach_id;
echo "   ";
echo "Make sure to write it down!";
} else {
echo "Error: " . $sql . "<br>" . $stmt->errorInfo()[2];
return False;
}
$stmt->closeCursor();

return True;
}

?>
