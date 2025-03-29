
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Makes - Admin</title>
</head>
<body>
    <h1>Manage Makes</h1>

    <h2>Add a New Make</h2>
    <form method="POST">
        <input type="text" name="make_name" required placeholder="Enter Make Name">
        <button type="submit">Add Make</button>
    </form>

    <h2>Existing Makes</h2>

    <!-- Sorting Form -->
    <form action="makes.php" method="get">
        <label>Sort by:</label>
        <select name="sort" onchange="this.form.submit()">
            <option value="id_asc" <?= ($sort === 'id_asc') ? 'selected' : '' ?>>ID (Low to High)</option>
            <option value="id_desc" <?= ($sort === 'id_desc') ? 'selected' : '' ?>>ID (High to Low)</option>
            <option value="name_asc" <?= ($sort === 'name_asc') ? 'selected' : '' ?>>Name (A-Z)</option>
            <option value="name_desc" <?= ($sort === 'name_desc') ? 'selected' : '' ?>>Name (Z-A)</option>
        </select>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($makes as $make) : ?>
            <tr>
                <td><?= $make['makeID'] ?></td>
                <td><?= htmlspecialchars($make['makeName']) ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this make?');">
                        <input type="hidden" name="delete_id" value="<?= $make['makeID'] ?>">
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
