<?php
require_once('../../model/database.php');
require_once('../../model/types_db.php');

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    delete_type($_POST['delete_id']);
    header("Location: manage_types.php");
    exit();
}

// Handle add request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type_name'])) {
    $type_name = trim($_POST['type_name']);
    if (!empty($type_name)) {
        add_type($type_name);
    }
    header("Location: manage_types.php");
    exit();
}

// Get all types
$types = get_types();

// Load the view
include('../view/manage_types_view.php');
?>
