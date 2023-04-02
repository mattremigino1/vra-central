<?php
function addFriend($name, $major, $year)
{
    global $db;

    $query = 'INSERT INTO friends
                 (name, major, year)
              VALUES
                 (:name, :major, :year)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);
    $statement->execute();
    $statement->closeCursor();
}

function selectAllFriends() {
    // db
    global $db;
    // query
    $query = "SELECT * FROM friends";
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

function deleteFriend($friend_to_delete) {

        // db
        global $db;
        // query
        $query = "DELETE FROM friends WHERE name=:friend_to_delete";
        // prepare
        $statement = $db->prepare($query);
        $statement->bindValue(':friend_to_delete', $friend_to_delete);
        // execute
        $statement->execute();
        // close cursor
        $statement->closeCursor();
}

function getFriendByName($friend_to_update) {
    global $db;
    $query = "SELECT * FROM friends WHERE name=:friend_to_update";
    // prepare
    $statement = $db->prepare($query);
    $statement->bindValue(':friend_to_update', $friend_to_update);
    // execute
    $statement->execute();
    $results = $statement->fetch(); //fetch() will retrieve only first row fetchAll will retrieve all rows
    // close cursor
    $statement->closeCursor();
    return $results;
}

function updateFriend($name, $major, $year)
{
    global $db;

    $query = "UPDATE friends SET major=:major, year=:year WHERE name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);
    $statement->execute();
    $statement->closeCursor();
}

?>