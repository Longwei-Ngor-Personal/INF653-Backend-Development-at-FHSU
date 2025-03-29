<?php
// Ensure $types is defined before rendering
if (!isset($types)) {
    die("Error: Types data is not available.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Types - Admin</title>
</head>
<body>
    <h1>Manage Types</h1>

    <h2>Add a New Type</h2>
    <form action="../controllers/manage_types.php" method="POST">
        <input type="text" name="type_name" required placeholder="Enter Type Name">
        <button type="submit">Add Type</button>
    </form>

    <h2>Existing Types</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($types as $type) : ?>
            <tr>
                <td><?= $type['typeID'] ?></td>
                <td><?= htmlspecialchars($type['typeName']) ?></td>
                <td>
                    <form action="../controllers/manage_types.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this type?');">
                        <input type="hidden" name="delete_id" value="<?= $type['typeID'] ?>">
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
