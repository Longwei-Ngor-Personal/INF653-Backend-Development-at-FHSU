<?php
require_once('model/assignment_db.php');
require_once('model/database.php');

// Get assignment ID from the URL (GET method)
$assignment_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$assignment_id) {
    echo "Invalid assignment ID.";
    exit();
}

// Fetch the current assignment details
$query = 'SELECT * FROM assignments WHERE ID = :assignment_id';
$statement = $db->prepare($query);
$statement->bindValue(':assignment_id', $assignment_id, PDO::PARAM_INT);
$statement->execute();
$assignment = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

if (!$assignment) {
    echo "Assignment not found.";
    exit();
}

// Fetch all available courses for the dropdown
$query = 'SELECT courseID, courseName FROM courses ORDER BY courseName';
$statement = $db->prepare($query);
$statement->execute();
$courses = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Assignment</title>
</head>
<body>
    <h1>Update Assignment</h1>
    <form action="index.php" method="POST">
        <!-- Hidden Fields -->
        <input type="hidden" name="action" value="update_assignment"> <!-- 🚀 NEW -->
        <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($assignment['ID']); ?>">

        <!-- Description Input Field -->
        <label for="description">Assignment Description:</label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($assignment['Description']); ?>" required>

        <!-- Course Dropdown -->
        <label for="course_id">Course:</label>
        <select id="course_id" name="course_id" required>
            <?php foreach ($courses as $course) { ?>
                <option value="<?php echo $course['courseID']; ?>"
                    <?php if (isset($assignment['courseID']) && $course['courseID'] == $assignment['courseID']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($course['courseName']); ?>
                </option>
            <?php } ?>
        </select>

        <!-- Submit Button -->
        <button type="submit">Update Assignment</button>
    </form>
</body>
</html>
