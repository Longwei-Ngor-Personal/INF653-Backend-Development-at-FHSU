<?php
require_once('database.php');

// Function to get all types with optional sorting
function get_types($sort = 'id') {
    global $db;
    
    // Define the query based on sort choice
    if ($sort == 'name') {
        $query = 'SELECT * FROM types ORDER BY typeName ASC';
    } else {
        $query = 'SELECT * FROM types ORDER BY typeID ASC';
    }
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new type
function add_type($type_name) {
    global $db;
    $query = 'INSERT INTO types (typeName) VALUES (:type_name)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':type_name', $type_name);
    $stmt->execute();
}

// Function to delete a type
function delete_type($type_id) {
    global $db;
    $query = 'DELETE FROM types WHERE typeID = :type_id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':type_id', $type_id);
    $stmt->execute();
}
?>
