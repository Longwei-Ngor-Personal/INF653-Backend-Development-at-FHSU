
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes - Admin</title>
</head>
<body>
    <h1>Manage Classes</h1>

    <h2>Add a New Class</h2>
    <form method="POST">
        <input type="text" name="class_name" required placeholder="Enter Class Name">
        <button type="submit">Add Class</button>
    </form>

    <h2>Existing Classes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($classes as $class) : ?>
            <tr>
                <td><?= $class['classID'] ?></td>
                <td><?= htmlspecialchars($class['className']) ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this class?');">
                        <input type="hidden" name="delete_id" value="<?= $class['classID'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <form action="../index.php" method="get" style="display:inline;">
        <button type="submit">Back to Admin Dashboard</button>
    </form>
</body>
</html>
