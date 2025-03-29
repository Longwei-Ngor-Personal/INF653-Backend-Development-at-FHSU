<?php
require_once('../../model/database.php');
require_once('../../model/vehicles_db.php');
require_once('../../model/makes_db.php');
require_once('../../model/types_db.php');
require_once('../../model/classes_db.php');

// Handle delete request
if (isset($_POST['delete_id'])) {
    delete_vehicle($_POST['delete_id']);
    header("Location: add_vehicles.php");
    exit();
}

// Handle add request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $model = trim($_POST['model']);
    $price = $_POST['price'];
    $make_id = $_POST['make_id'];
    $type_id = $_POST['type_id'];
    $class_id = $_POST['class_id'];

    if (!empty($year) && !empty($model) && !empty($price) && !empty($make_id) && !empty($type_id) && !empty($class_id)) {
        add_vehicle($year, $model, $price, $make_id, $type_id, $class_id);
        $message = "Vehicle added successfully!";
    } else {
        $message = "All fields are required!";
    }
    header("Location: add_vehicles.php");
    exit();
}

// Get sorting/filtering options
$make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
$type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);

// Get sorting parameters (default to price descending)
$sort_price = filter_input(INPUT_GET, 'sort_price', FILTER_SANITIZE_SPECIAL_CHARS);
$sort_year = filter_input(INPUT_GET, 'sort_year', FILTER_SANITIZE_SPECIAL_CHARS);

// Get filtered & sorted vehicles
$vehicles = get_vehicles_filtered($make_id, $type_id, $class_id, $sort_price, $sort_year);
$makes = get_makes();
$types = get_types();
$classes = get_classes();

// Load the view
include('../view/add_vehicles_view.php');
?>
