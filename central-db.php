<?php

function getEights() {
    global $db;
    $query = "SELECT * FROM EightMan";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getFours() {
    global $db;
    $query = "SELECT * FROM FourMan";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}
function getTwoMan() {
    global $db;
    $query = "SELECT * FROM TwoMan";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getSingle() {
    global $db;
    $query = "SELECT * FROM Single";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function myLineup($athlete_id) {
    global $db;
    $query = "SELECT boat_name, seat FROM RowsIn WHERE athlete_id = :athlete_id";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    if (!$results) {
        return array("Not Boated", "--");
    }
    return array($results["boat_name"], $results["seat"]);
}

function getName($athlete_id) {
    global $db;
    $query = "SELECT CONCAT(first_name, ' ', last_name) AS Name FROM Athlete WHERE athlete_id = :athlete_id";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    if (!$results) {
        return array("--");
    }
    return $results;
}

function getBoatSide($athlete_id) {
    global $db;
    $query = "SELECT boat_side FROM Athlete WHERE athlete_id = :athlete_id";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    if (!$results) {
        return array("--");
    }
    return $results;
}

function getNameC($coach_id) {
    global $db;
    $query = "SELECT CONCAT(first_name, ' ', last_name) AS Name FROM Coach WHERE coach_id = :coach_id";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':coach_id', $coach_id);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    if (!$results) {
        return array("--");
    }
    return $results;
}

function getTodayWorkout() {
    global $db;
    $query = "SELECT practice_num, dte, descr FROM DailyWorkout NATURAL JOIN Practices WHERE dte IN (CURDATE())";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getTmrrwWorkout() {
    global $db;
    $query = "SELECT practice_num, dte, descr FROM DailyWorkout NATURAL JOIN Practices WHERE dte = (CURDATE() + INTERVAL 1 DAY)";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getExtraWorkouts($athlete_id) {
    global $db;
    $query = "SELECT athlete_id, workout_num, dte, mins, workout_type, descr FROM ExtraWork WHERE athlete_id = :athlete_id";
    // prepare
     // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getTotalMins($athlete_id) {
    global $db;
    $query = "SELECT SUM(mins) AS total FROM ExtraWork GROUP BY athlete_id HAVING athlete_id = :athlete_id";
    // prepare
     // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    if (!$results) {
        return array("--");
    }
    return $results;
}

function getAthletes() {
    global $db;
    $query = "SELECT CONCAT(first_name, ' ', last_name) AS Name, athlete_id FROM Athlete";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function deleteWorkout($athlete_id, $workout_num) {
    global $db;
    $query = "DELETE FROM ExtraWork WHERE athlete_id=:athlete_id AND workout_num = :workout_num";
    // prepare
     // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    $statement->bindValue(':workout_num', $workout_num);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();
}

function getBoats() {
    global $db;
    $query = "SELECT boat_name AS Name, num_seats FROM Boats";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getBoatLineup($boat_name) {
    global $db;
    $table = "";

    // get number of seats
    $query = "SELECT num_seats FROM Boats WHERE boat_name = :boat_name";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':boat_name', $boat_name);
    // execute
    $statement->execute();
    $seat_num = $statement->fetch()[0];
    $statement->closeCursor();

    if ($seat_num == "8") {
        $table = "EightMan";
    } else if ($seat_num == "4") {
        $table = "FourMan";
    } else if ($seat_num == "2") {
        $table = "TwoMan";
    } else {
        $table = "Single";
    }
    $query = "SELECT * FROM $table WHERE boat_name = :boat_name";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':boat_name', $boat_name);
    // execute
    $statement->execute();
    $results = $statement->fetch();
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getBoatInfo($boat_name) {
    global $db;
    $query = "SELECT boat_name AS Name, num_seats FROM Boats WHERE boat_name = :boat_name";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':boat_name', $boat_name);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function createEightLineup($boat, $cox, $stroke, $seven, $six, $five, $four, $three, $two, $bow, $oars, $rig) {
    global $db;

    changeSeat($boat, $cox, "0");
    changeSeat($boat, $stroke, "8");
    changeSeat($boat, $seven, "7");
    changeSeat($boat, $six, "6");
    changeSeat($boat, $five, "5");
    changeSeat($boat, $four, "4");
    changeSeat($boat, $three, "3");
    changeSeat($boat, $two, "2");
    changeSeat($boat, $bow, "1");

    $query = "UPDATE EightMan SET oars=:oars, rigging=:rig WHERE boat_name = :boat";
    $statement = $db->prepare($query);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':oars', $oars);
    $statement->bindValue(':rig', $rig);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();

}

function createFourLineup($boat, $cox, $stroke, $three, $two, $bow, $oars, $rig) {
    global $db;

    changeSeat($boat, $cox, "0");
    changeSeat($boat, $stroke, "4");
    changeSeat($boat, $three, "3");
    changeSeat($boat, $two, "2");
    changeSeat($boat, $bow, "1");

    $query = "UPDATE FourMan SET oars=:oars, rigging=:rig WHERE boat_name = :boat";
    $statement = $db->prepare($query);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':oars', $oars);
    $statement->bindValue(':rig', $rig);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();

}

function createTwoLineup($boat, $stroke, $bow, $oars, $rig) {
    global $db;

    changeSeat($boat, $stroke, "2");
    changeSeat($boat, $bow, "1");

    $query = "UPDATE TwoMan SET oars=:oars, rigging=:rig WHERE boat_name = :boat";
    $statement = $db->prepare($query);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':oars', $oars);
    $statement->bindValue(':rig', $rig);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();

}

function createSingleLineup($boat, $stroke, $oars) {
    global $db;

    changeSeat($boat, $stroke, "1");

    $query = "UPDATE Single SET oars=:oars WHERE boat_name = :boat";
    $statement = $db->prepare($query);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':oars', $oars);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();
}

function changeSeat($boat, $athlete_id, $seat) {
    global $db;
    // remove the person currentlty in that seat of the boat
    $query = "DELETE FROM RowsIn WHERE boat_name = :boat AND seat=:seat";
    $statement = $db->prepare($query);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':seat', $seat);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();

    // remove the athlete from the lineup they are currently in
    $query = "DELETE FROM RowsIn WHERE athlete_id = :athlete_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();

    // add the athlete to the new lineup
    $query = "INSERT INTO RowsIn VALUES (:athlete_id, :boat, :seat)";
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_id', $athlete_id);
    $statement->bindValue(':boat', $boat);
    $statement->bindValue(':seat', $seat);
    // execute
    $statement->execute();
    // close cursor
    $statement->closeCursor();
}

function get2WeeksPractices() {
    global $db;
    $query = "SELECT * FROM DailyWorkout NATURAL JOIN Practices WHERE dte <= (CURDATE() + INTERVAL 7 DAY) AND dte >= (CURDATE() - INTERVAL 7 DAY)";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function getWorkouts() {
    global $db;
    $query = "SELECT * FROM DailyWorkout";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function createPractice($practice_num, $dte, $workout_id) 
{ 
    global $db;

    // prepare and execute the insert statement
    $query = "INSERT INTO Practices
        VALUES (:practice_num, :dte, :workout_id)";

    $stmt = $db->prepare($query);

    $stmt->bindValue(':practice_num', $practice_num);
    $stmt->bindValue(':dte', $dte);
    $stmt->bindValue(':workout_id', $workout_id);


    try {
        $stmt->execute();
    }
    Catch(Exception $e){
        echo "Error Occured ... you likely input a date and practice number combination you have already logged ... please try again";
        $stmt->closeCursor();
        return False;
    }
    $stmt->closeCursor();

    return True;
}

function createDailyWorkout($descr) {
    global $db;

    // prepare and execute the insert statement
    $query = "INSERT INTO DailyWorkout (descr)
        VALUES (:descr)";

    $stmt = $db->prepare($query);

    $stmt->bindValue(':descr', $descr);


    try {
        $stmt->execute();
    }
    Catch(Exception $e){
        echo "Error Occured ... please try again";
        $stmt->closeCursor();
        return False;
    }
    $stmt->closeCursor();

    return True;
}

function createAbsence($athlete_id, $practice_num, $dte) {
    global $db;

    // prepare and execute the insert statement
    $query = "INSERT INTO Attendance (athlete_id, practice_num, dte, attended)
        VALUES (:athlete_id, :practice_num, :dte, 'N')";

    $stmt = $db->prepare($query);

    $stmt->bindValue(':athlete_id', $athlete_id);
    $stmt->bindValue(':practice_num', $practice_num);
    $stmt->bindValue(':dte', $dte);


    try {
        $stmt->execute();
    }
    Catch(Exception $e){
        echo "Error Occured ... you likely input a date and practice number combination you have already logged ...please try again";
        $stmt->closeCursor();
        return False;
    }
    $stmt->closeCursor();

    return True;
}

function getabsences() {
    global $db;
    $query = "SELECT * FROM Attendance WHERE dte >= CURDATE()";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}


?>