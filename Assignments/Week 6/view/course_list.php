<?php include("view/header.php"); ?>

<section class="course-container">
    <h1>Course List</h1>

    <!-- Display Courses as Editable Fields -->
    <?php if (!empty($courses)) : ?>
        <?php foreach ($courses as $course) : ?>
            <form action="index.php" method="post" class="list__row">
                <input type="hidden" name="course_id" value="<?= $course['courseID']; ?>">
                <input type="hidden" name="action" value="update_course">
                <input type="text" name="course_name" value="<?= htmlspecialchars($course['courseName']); ?>" required>
                
                <button type="submit">Update</button>
                <button type="submit" name="action" value="delete_course" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
            </form>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No courses exist yet.</p>
    <?php endif; ?>
</section>

<!-- Add New Course Form -->
<section>
    <h2>Add Course</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_course">
        <input type="text" name="course_name" maxlength="30" placeholder="Course Name" required>
        <button type="submit">Add</button>
    </form>
</section>

<p><a href=".?action=list_assignments">View/Edit Assignments</a></p>

<?php include("view/footer.php"); ?>
