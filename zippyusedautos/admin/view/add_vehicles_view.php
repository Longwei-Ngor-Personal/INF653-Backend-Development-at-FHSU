
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Vehicles - Admin</title>
</head>
<body>
    <h1>Manage Vehicles</h1>

    <?php if (isset($message)) : ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <h2>Add a New Vehicle</h2>
    <form method="POST">
        <input type="number" name="year" required placeholder="Year">
        <input type="text" name="model" required placeholder="Model">
        <input type="number" name="price" required placeholder="Price">
        
        <select name="make_id" required>
            <option value="">Select Make</option>
            <?php foreach ($makes as $make) : ?>
                <option value="<?= $make['makeID'] ?>"><?= htmlspecialchars($make['makeName']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="type_id" required>
            <option value="">Select Type</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['typeID'] ?>"><?= htmlspecialchars($type['typeName']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="class_id" required>
            <option value="">Select Class</option>
            <?php foreach ($classes as $class) : ?>
                <option value="<?= $class['classID'] ?>"><?= htmlspecialchars($class['className']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Add Vehicle</button>
    </form>

    <h2>Existing Vehicles</h2>
    
    <!-- Sorting and Filtering Form -->
    <form method="GET" action="add_vehicles.php">
        <select name="make_id">
            <option value="">All Makes</option>
            <?php foreach ($makes as $make) : ?>
                <option value="<?= $make['makeID'] ?>" <?= $make_id == $make['makeID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($make['makeName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="type_id">
            <option value="">All Types</option>
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['typeID'] ?>" <?= $type_id == $type['typeID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['typeName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="class_id">
            <option value="">All Classes</option>
            <?php foreach ($classes as $class) : ?>
                <option value="<?= $class['classID'] ?>" <?= $class_id == $class['classID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($class['className']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="sort_price">
            <option value="">Sort by Price</option>
            <option value="price_asc" <?= $sort_price === 'price_asc' ? 'selected' : '' ?>>Low to High</option>
            <option value="price_desc" <?= $sort_price === 'price_desc' ? 'selected' : '' ?>>High to Low</option>
        </select>

        <select name="sort_year">
            <option value="">Sort by Year</option>
            <option value="year_asc" <?= $sort_year === 'year_asc' ? 'selected' : '' ?>>Oldest to Newest</option>
            <option value="year_desc" <?= $sort_year === 'year_desc' ? 'selected' : '' ?>>Newest to Oldest</option>
        </select>

        <button type="submit">Filter</button>
        <button type="button" onclick="window.location='add_vehicles.php'">Clear Filters</button>
    </form>

    <br>

    <!-- Display filtered and sorted vehicles -->
    <?php if (empty($vehicles)) : ?>
        <p><strong>No Matches Found.</strong></p>
    <?php else : ?>
        <table border="1">
            <tr>
                <th>Year</th>
                <th>Model</th>
                <th>Price</th>
                <th>Type</th>
                <th>Class</th>
                <th>Make</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($vehicles as $vehicle) : ?>
                <tr>
                    <td><?= $vehicle['year'] ?></td>
                    <td><?= htmlspecialchars($vehicle['model']) ?></td>
                    <td>$<?= number_format($vehicle['price']) ?></td>
                    <td><?= htmlspecialchars($vehicle['typeName']) ?></td>
                    <td><?= htmlspecialchars($vehicle['className']) ?></td>
                    <td><?= htmlspecialchars($vehicle['makeName']) ?></td>
                    <td>
                        <form method="GET" action="edit_vehicles.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $vehicle['vehicleID'] ?>">
                            <button type="submit">Edit</button>
                        </form> |
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this vehicle?');" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?= $vehicle['vehicleID'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <br>
    <form action="../index.php" method="get" style="display:inline;">
        <button type="submit">Back to Admin Dashboard</button>
    </form>

</body>
</html>
