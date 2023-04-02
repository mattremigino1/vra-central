<?php
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

?>