<?php

function selectAllAthletes() {
    // db
    global $db;
    // query
    $query = "SELECT * FROM Athlete";
    // prepare
    $statement = $db->prepare($query);
    // execute
    $statement->execute();
    // retrieve
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();

    return $results;
}

function deleteAthlete($athlete_to_delete) {

        // db
        global $db;
        // query
        $query = "DELETE FROM Athlete WHERE athlete_id=:athlete_to_delete";
        // prepare
        $statement = $db->prepare($query);
        $statement->bindValue(':athlete_to_delete', $athlete_to_delete);
        // execute
        $statement->execute();
        // close cursor
        $statement->closeCursor();
}

function getAthleteByName($athlete_to_update) {
    global $db;
    $query = "SELECT * FROM Athlete WHERE first_name=:athlete_to_update";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':athlete_to_update', $athlete_to_update);
    // execute
    $statement->execute();
    $results = $statement->fetchAll(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

?>