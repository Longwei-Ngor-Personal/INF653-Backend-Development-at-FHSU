<?php
require_once('../../model/database.php');
require_once('../../model/classes_db.php');

// Handle delete request
if (isset($_POST['delete_id'])) {
    delete_class($_POST['delete_id']);
    header("Location: manage_classes.php");
    exit();
}

// Handle add request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class_name'])) {
    $class_name = trim($_POST['class_name']);
    if (!empty($class_name)) {
        add_class($class_name);
    }
    header("Location: manage_classes.php");
    exit();
}

// Get all classes
$classes = get_classes();

// Load the view
include('../view/manage_classes_view.php');
?>
