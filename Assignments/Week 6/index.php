<?php
require_once('model/database.php');
require_once('model/assignment_db.php');
require_once('model/course_db.php');

// Get the action to determine which section to show
$action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW) ?: 'list_assignments';

// Fetch data
$courses = get_courses();
$course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
$assignments = get_assignments_by_course($course_id);

// Process form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
    $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
    $assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($action === "add_course" && !empty($course_name)) {
        add_course($course_name);
        header("Location: index.php?action=list_courses");
        exit();
    } elseif ($action === "update_course" && $course_id && !empty($course_name)) {
        update_course($course_id, $course_name);
        header("Location: index.php?action=list_courses");
        exit();
    } elseif ($action === "delete_course" && $course_id) {
        delete_course($course_id);
        header("Location: index.php?action=list_courses");
        exit();
    } elseif ($action === "add_assignment" && $course_id && !empty($description)) {
        add_assignment($course_id, $description);
        header("Location: index.php?action=list_assignments&course_id=" . $course_id);
        exit();
    } elseif ($action === "update_assignment" && $assignment_id && $course_id && !empty($description)) {
        update_assignment($assignment_id, $description, $course_id);
        header("Location: index.php?action=list_assignments&course_id=" . $course_id);
        exit();
    } elseif ($action === "delete_assignment" && $assignment_id) {
        delete_assignment($assignment_id);
        header("Location: index.php?action=list_assignments&course_id=" . $course_id);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course & Assignment Management</title>
</head>
<body>
    <h1>Course & Assignment Management</h1>

    <!-- Navigation Links
    <nav>
        <a href="index.php?action=list_assignments">View/Edit Assignments</a> |
        <a href="index.php?action=list_courses">View/Edit Courses</a>
    </nav> -->

    <?php
    if ($action === 'list_courses') {
        include('view/course_list.php');  // Show Course Management
    } else {
        include('view/assignment_list.php');  // Show Assignment Management (Default)
    }
    ?>
</body>
</html>
