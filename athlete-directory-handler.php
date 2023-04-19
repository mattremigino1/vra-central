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

function getAthleteByName($athlete_id) {
    global $db;
    $query = "SELECT * FROM Athlete WHERE athlete_id=:athlete_id";
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

?>