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

?>