<?php
require_once('../../model/database.php');
require_once('../../model/makes_db.php');

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    delete_make($_POST['delete_id']);
    header("Location: manage_makes.php");
    exit();
}

// Handle add request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['make_name'])) {
    $make_name = trim($_POST['make_name']);
    if (!empty($make_name)) {
        add_make($make_name);
    }
    header("Location: manage_makes.php");
    exit();
}

// Get sorting option
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_SPECIAL_CHARS) ?: 'id_asc';

// Fetch sorted makes
$makes = get_makes($sort);

// Load the view
include('../view/manage_makes_view.php');
?>
