<?php
require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');

// Get sorting/filtering options
$sort_price = filter_input(INPUT_GET, 'sort_price', FILTER_SANITIZE_SPECIAL_CHARS);
$sort_year = filter_input(INPUT_GET, 'sort_year', FILTER_SANITIZE_SPECIAL_CHARS);
$make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
$type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);

// Get filtered & sorted vehicles
$vehicles = get_vehicles_filtered($make_id, $type_id, $class_id, $sort_price, $sort_year);
$makes = get_makes();
$types = get_types();
$classes = get_classes();

// Handle vehicle deletion
if (isset($_POST['delete_id'])) {
    delete_vehicle($_POST['delete_id']);
    header('Location: index.php'); // Refresh after deletion
    exit(); // Ensure script stops after redirect
}

include('view/vehicle_list_admin.php');
?>
