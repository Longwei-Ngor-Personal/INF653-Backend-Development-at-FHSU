<!-- Vehicle List Public View -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zippy Used Autos</title>
</head>
<body>
    <h1>Zippy Used Autos</h1>

    <!-- Sorting and Filtering Form -->
    <form action="index.php" method="get">
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

        <!-- Sort by Price -->
        <select name="sort_price">
            <option value="">Sort by Price</option>
            <option value="price_asc" <?= $sort_price === 'price_asc' ? 'selected' : '' ?>>Low to High</option>
            <option value="price_desc" <?= $sort_price === 'price_desc' ? 'selected' : '' ?>>High to Low</option>
        </select>

        <!-- Sort by Year -->
        <select name="sort_year">
            <option value="">Sort by Year</option>
            <option value="year_asc" <?= $sort_year === 'year_asc' ? 'selected' : '' ?>>Oldest to Newest</option>
            <option value="year_desc" <?= $sort_year === 'year_desc' ? 'selected' : '' ?>>Newest to Oldest</option>
        </select>

        <button type="submit">Filter</button>
        <button type="button" onclick="window.location='index.php'">Clear Filters</button>
    </form>

    <h2>Vehicles</h2>

    <?php if (empty($vehicles)) : ?>
        <p><strong>No Matches Found</strong></p> <!-- Message for no results -->
    <?php else : ?>
        <table border="1">
            <tr>
                <th>Year</th>
                <th>Model</th>
                <th>Price</th>
                <th>Type</th>
                <th>Class</th>
                <th>Make</th>
            </tr>
            <?php foreach ($vehicles as $vehicle) : ?>
                <tr>
                    <td><?= $vehicle['year'] ?></td>
                    <td><?= htmlspecialchars($vehicle['model']) ?></td>
                    <td>$<?= number_format($vehicle['price']) ?></td>
                    <td><?= htmlspecialchars($vehicle['typeName']) ?></td>
                    <td><?= htmlspecialchars($vehicle['className']) ?></td>
                    <td><?= htmlspecialchars($vehicle['makeName']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
