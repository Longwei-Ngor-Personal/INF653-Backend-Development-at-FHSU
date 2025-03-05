<?php
require_once('model/course_db.php');
require_once('model/database.php');

// Get course ID from URL (GET method)
$course_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$course_id) {
    echo "Invalid course ID.";
    exit();
}

// Fetch the current course details
$query = 'SELECT * FROM courses WHERE courseID = :course_id';
$statement = $db->prepare($query);
$statement->bindValue(':course_id', $course_id, PDO::PARAM_INT);
$statement->execute();
$course = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

if (!$course) {
    echo "Course not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
</head>
<body>
    <h1>Update Course</h1>
    <form action="index.php" method="POST">
        <!-- Hidden Field for Course ID -->
        <input type="hidden" name="action" value="update_course"> <!-- 🚀 NEW -->
        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['courseID']); ?>">

        <!-- Course Name Input -->
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course['courseName']); ?>" required>

        <!-- Submit Button -->
        <button type="submit">Update Course</button>
    </form>
</body>
</html>
