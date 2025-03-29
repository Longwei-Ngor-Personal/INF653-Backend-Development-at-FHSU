<?php
require_once('../../model/database.php');
require_once('../../model/vehicles_db.php');
require_once('../../model/makes_db.php');
require_once('../../model/types_db.php');
require_once('../../model/classes_db.php');

// Get the vehicle ID from the query string
$vehicle_id = $_GET['id'] ?? null;

if ($vehicle_id) {
    // Fetch the vehicle details to populate the form
    $vehicle = get_vehicle_by_id($vehicle_id);
    if (!$vehicle) {
        echo "Vehicle not found.";
        exit;
    }
}

// Handle the form submission to update the vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $model = trim($_POST['model']);
    $price = $_POST['price'];
    $make_id = $_POST['make_id'];
    $type_id = $_POST['type_id'];
    $class_id = $_POST['class_id'];

    if (!empty($year) && !empty($model) && !empty($price) && !empty($make_id) && !empty($type_id) && !empty($class_id)) {
        update_vehicle($vehicle_id, $year, $model, $price, $make_id, $type_id, $class_id);
        header("Location: ../index.php"); // Redirect to the vehicle list page
        exit();
    }
}

// Fetch makes, types, and classes for the dropdowns
$makes = get_makes();
$types = get_types();
$classes = get_classes();

// Load the view
include('../view/edit_vehicles_view.php');
?>
