<?php

require("database.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)
if($id){
    $query = 'DELETE FROM city
                WHERE ID = :id';
    $statement = $db->prepare($id);
    $statement->bondValue(":id", $id);
    $success = $statement->exceute();
    $statement->closeCursor();
} else {
    echo "No Data Found";
}

$delete = true;

include("index.php");
?>