<?php

function createWorkout($athlete_id, $workout_num, $mins, $dte, $workout_type, $descr) 
{ 
    global $db;

// prepare and execute the insert statement
$query = "INSERT INTO ExtraWork (athlete_id, workout_num, mins, dte, workout_type, descr)
        VALUES (:athlete_id, :workout_num, :mins, :dte, :workout_type, :descr)";

$stmt = $db->prepare($query);

$stmt->bindValue(':athlete_id', $athlete_id);
$stmt->bindValue(':workout_num', $workout_num);
$stmt->bindValue(':mins', $mins);
$stmt->bindValue(':dte', $dte);
$stmt->bindValue(':workout_type', $workout_type);
$stmt->bindValue(':descr', $descr);


try {
    $stmt->execute();
}
Catch(Exception $e){
    echo "Error Occured ... you likely input a date and workout number combination you have already logged ... please try again";
    $stmt->closeCursor();
    return False;
}



$stmt->closeCursor();

return True;
}

?>
