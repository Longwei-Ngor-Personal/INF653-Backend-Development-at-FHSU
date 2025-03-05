<?php include('view/header.php'); ?>

<section class="assignment-container">
    <h2>Assignments</h2>

    <!-- Dropdown to Filter Assignments by Course -->
    <form action="index.php" method="get">
        <select name="course_id">
            <option value="0" <?= !$course_id ? 'selected' : '' ?>>View All</option>
            <?php if (!empty($courses)) : ?>
                <?php foreach ($courses as $course) : ?>
                    <option value="<?= $course['courseID'] ?>" <?= ($course_id == $course['courseID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($course['courseName']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="">No Courses Available</option>
            <?php endif; ?>
        </select>
        <button type="submit">Go</button>
    </form>


    <!-- Display Assignments as Editable Fields -->
    <?php if (!empty($assignments)) : ?>
        <?php foreach ($assignments as $assignment) : ?>
            <form action="index.php" method="post" class="assignment-item">
                <input type="hidden" name="assignment_id" value="<?= $assignment['ID'] ?>">
                <input type="hidden" name="action" value="update_assignment">
                <input type="text" name="description" value="<?= htmlspecialchars($assignment['Description']) ?>" required>

                <select name="course_id" required>
                    <?php foreach ($courses as $course) : ?>
                        <option value="<?= $course['courseID'] ?>" <?= $assignment['courseName'] == $course['courseName'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($course['courseName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">Update</button>
                <button type="submit" name="action" value="delete_assignment" onclick="return confirm('Are you sure you want to delete this assignment?')">Delete</button>
            </form>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No assignments exist<?= $course_id ? ' for this course' : '' ?> yet.</p>
    <?php endif; ?>
</section>

<!-- Add New Assignment Form -->
<section class="assignment-container">
    <h2>Add Assignment</h2>
    <form action="." method="post">
        <input type="hidden" name="action" value="add_assignment">
        <select name="course_id" required>
            <option value="">Please select</option>
            <?php foreach ($courses as $course) : ?>
                <option value="<?= $course['courseID'] ?>"><?= htmlspecialchars($course['courseName']); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="description" maxlength="120" placeholder="Description" required>
        <button type="submit">Add</button>
    </form>
</section>

<p><a href=".?action=list_courses">View/Edit Courses</a></p>

<?php include('view/footer.php'); ?>
