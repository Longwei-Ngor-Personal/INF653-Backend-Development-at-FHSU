<?php
require_once('database.php');

// Function to get all classes with optional sorting
function get_classes($sort = 'id') {
    global $db;
    
    // Define the query based on sort choice
    if ($sort == 'name') {
        $query = 'SELECT * FROM classes ORDER BY className ASC';
    } else {
        $query = 'SELECT * FROM classes ORDER BY classID ASC';
    }
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new class
function add_class($class_name) {
    global $db;
    $query = 'INSERT INTO classes (className) VALUES (:class_name)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':class_name', $class_name);
    $stmt->execute();
}

// Function to delete a class
function delete_class($class_id) {
    global $db;
    $query = 'DELETE FROM classes WHERE classID = :class_id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':class_id', $class_id);
    $stmt->execute();
}
?>
