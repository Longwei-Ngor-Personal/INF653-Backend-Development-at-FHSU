
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle - Admin</title>
</head>
<body>
    <h1>Edit Vehicle</h1>

    <form method="POST">
        <input type="number" name="year" value="<?= $vehicle['year'] ?>" required placeholder="Year">
        <input type="text" name="model" value="<?= htmlspecialchars($vehicle['model']) ?>" required placeholder="Model">
        <input type="number" name="price" value="<?= $vehicle['price'] ?>" required placeholder="Price">
        
        <select name="make_id" required>
            <option value="">Select Make</option>
            <?php foreach ($makes as $make) : ?>
                <option value="<?= $make['makeID'] ?>" <?= $make['makeID'] == $vehicle['makeID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($make['makeName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="type_id" required>
            <option value="">Select Type</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['typeID'] ?>" <?= $type['typeID'] == $vehicle['typeID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['typeName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="class_id" required>
            <option value="">Select Class</option>
            <?php foreach ($classes as $class) : ?>
                <option value="<?= $class['classID'] ?>" <?= $class['classID'] == $vehicle['classID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($class['className']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Vehicle</button>
    </form>

    <br>
    <form action="../index.php" method="get" style="display:inline;">
        <button type="submit">Back to Admin Dashboard</button>
    </form>
</body>
</html>
