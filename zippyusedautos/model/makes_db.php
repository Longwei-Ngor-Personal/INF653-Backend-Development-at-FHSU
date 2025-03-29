<?php
function get_makes($sort = 'id_asc') {
    global $db;

    // Determine sorting order
    switch ($sort) {
        case 'id_asc':
            $orderBy = "ORDER BY makeID ASC";
            break;
        case 'id_desc':
            $orderBy = "ORDER BY makeID DESC";
            break;
        case 'name_asc':
            $orderBy = "ORDER BY makeName ASC";
            break;
        case 'name_desc':
            $orderBy = "ORDER BY makeName DESC";
            break;
        default:
            $orderBy = "ORDER BY makeID ASC"; // Default sorting
    }

    $query = "SELECT * FROM makes $orderBy";
    $statement = $db->prepare($query);
    $statement->execute();
    $makes = $statement->fetchAll();
    $statement->closeCursor();

    return $makes;
}


function add_make($make_name) {
    global $db;
    $query = "INSERT INTO makes (makeName) VALUES (:make_name)";
    $statement = $db->prepare($query);
    $statement->bindValue(':make_name', $make_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_make($make_id) {
    global $db;
    $query = "DELETE FROM makes WHERE makeID = :make_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}
?>
