<?php
require_once("database.php");
//POST Data
$newCity = filter_input(INPUT_POST, "newCity", FILTER_UNSAFE_RAW);
$countryCode = filter_input(INPUT_POST, "countryCode", FILTER_UNSAFE_RAW);
$district = filter_input(INPUT_POST, "district", FILTER_UNSAFE_RAW);
$population = filter_input(INPUT_POST, "population", FILTER_UNSAFE_RAW);

//GET Data
$city = filter_input(INPUT_GET, "city", FILTER_UNSAFE_RAW);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
<main>
    <header>
        <h1>Week 4 Connecting to Database</h1>
        <?php
        if(isset($delete)){
            echo "Record is deleted successfully. <br>";
        } else if (isset($update)){
            echo "Record id updated successfully. <br>";
        }
        ?>
        <?php
        if($newCity){
            $query = 'INSERT INTO city
                        (Name, CountryCode, District, Population)
                        VALUES
                        (:newCity, countryCode, district, population)';
            $statement = $db->prepare($query);
            $statement->bindValue(':newCity', $newCity);            
            $statement->bindValue(':countryCode', $countryCode);            
            $statement->bindValue(':district', $district);            
            $statement->bindValue(':population', $population);
            $statement->execute();
            $statement->closeCursor();
        }
        ?>
        <?php
        if(!$city || $newCity){ ?>
            <section>
                <h2>Select Data / Read Data<h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                    <label for="city">City Name:</label>
                    <input type="text" id="city" name="city" required>
                    <button>Submit</button>
                </form>
            </section>
            <section>
                <h2>Insert Data / Create Data<h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label for="newCity">New City:</label>
                    <input type="text" id="newCity" name="newCity" required>
                    <label for="countryCode">Country Code:</label>
                    <input type="text" id="countryCode" name="countryCode" required>
                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" required>
                    <label for="population">Population:</label>
                    <input type="text" id="population" name="population" required>
                    <button>Submit</button>
                </form>
            </section>
        <?php} if(!empty($results)){?>
            <section>
                <h2>Update or Delete Data:</h2>
                <h2>City Details:</h2>
                <ul>
                    <?php foreach($results as $row) {?>
                        <li><strong>ID:</strong><?php echo htmlspecialchars($row['ID']);?></li>
                        <li><strong>City:</strong><?php echo htmlspecialchars($row['Name']);?></li>
                        <li><strong>Country Code:</strong><?php echo htmlspecialchars($row['CountryCode']);?></li>
                        <li><strong>District:</strong><?php echo htmlspecialchars($row['District']);?></li>
                        <li><strong>Population:</strong><?php echo htmlspecialchars($row['Population']);?></li>
                        <form action="update_record.php" class="update" method="POST">
                            <input type="hidden" name ="id" value="<?php echo $row['ID']?>" required>
                        </form>
                        <form action="delete_record.php" class="delete" method="POST">
                            <input type="hidden" name ="id" value="<?php echo $row['ID']?>" required>
                        </form>
                </ul>
            </section>
        <?php }} else{?>
            <?php include("database.php")?>
            <?php if($city || $newCity){
                $query = 'SELECT * FROM city WHERE Name=:city ORDER BY Population DESC';
                $statement= $db->prepare($query);
                if ($city){
                    $statement->bindValue(":city", $city);
                } else {
                    $statement->bindValue(":city", $newCity);
                }
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();
                echo $results;
            }?>
        <?php } ?>
    </header>
</main>    
</body>
</html>

<?php
require_once("database.php");

// POST Data
$newCity = filter_input(INPUT_POST, "newCity", FILTER_SANITIZE_STRING);
$countryCode = filter_input(INPUT_POST, "countryCode", FILTER_SANITIZE_STRING);
$district = filter_input(INPUT_POST, "district", FILTER_SANITIZE_STRING);
$population = filter_input(INPUT_POST, "population", FILTER_SANITIZE_NUMBER_INT);

// GET Data
$city = filter_input(INPUT_GET, "city", FILTER_SANITIZE_STRING);

// Insert Data
if ($newCity) {
    $query = 'INSERT INTO city (Name, CountryCode, District, Population)
              VALUES (:newCity, :countryCode, :district, :population)';
    $statement = $db->prepare($query);
    $statement->bindValue(':newCity', $newCity);
    $statement->bindValue(':countryCode', $countryCode);
    $statement->bindValue(':district', $district);
    $statement->bindValue(':population', $population);
    $statement->execute();
    $statement->closeCursor();
}

// Fetch Data
if ($city || $newCity) {
    $query = 'SELECT * FROM city WHERE Name = :city ORDER BY Population DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(":city", $city ?: $newCity);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
<main>
    <header>
        <h1>Week 4 Connecting to Database</h1>

        <?php if (isset($delete)) { ?>
            <p>Record deleted successfully.</p>
        <?php } elseif (isset($update)) { ?>
            <p>Record updated successfully.</p>
        <?php } ?>

        <section>
            <h2>Select Data / Read Data</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                <label for="city">City Name:</label>
                <input type="text" id="city" name="city" required>
                <button>Submit</button>
            </form>
        </section>

        <section>
            <h2>Insert Data / Create Data</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="newCity">New City:</label>
                <input type="text" id="newCity" name="newCity" required>
                <label for="countryCode">Country Code:</label>
                <input type="text" id="countryCode" name="countryCode" required>
                <label for="district">District:</label>
                <input type="text" id="district" name="district" required>
                <label for="population">Population:</label>
                <input type="number" id="population" name="population" required>
                <button>Submit</button>
            </form>
        </section>

        <?php if (!empty($results)) { ?>
            <section>
                <h2>Update or Delete Data:</h2>
                <h2>City Details:</h2>
                <ul>
                    <?php foreach ($results as $row) { ?>
                        <li><strong>ID:</strong> <?php echo htmlspecialchars($row['ID']); ?></li>
                        <li><strong>City:</strong> <?php echo htmlspecialchars($row['Name']); ?></li>
                        <li><strong>Country Code:</strong> <?php echo htmlspecialchars($row['CountryCode']); ?></li>
                        <li><strong>District:</strong> <?php echo htmlspecialchars($row['District']); ?></li>
                        <li><strong>Population:</strong> <?php echo htmlspecialchars($row['Population']); ?></li>

                        <!-- Update Form -->
                        <form action="update_record.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                            <label for="updatedCity">City Name:</label>
                            <input type="text" name="updatedCity" value="<?php echo htmlspecialchars($row['Name']); ?>" required>

                            <label for="updatedCountryCode">Country Code:</label>
                            <input type="text" name="updatedCountryCode" value="<?php echo htmlspecialchars($row['CountryCode']); ?>" required>

                            <label for="updatedDistrict">District:</label>
                            <input type="text" name="updatedDistrict" value="<?php echo htmlspecialchars($row['District']); ?>" required>

                            <label for="updatedPopulation">Population:</label>
                            <input type="number" name="updatedPopulation" value="<?php echo htmlspecialchars($row['Population']); ?>" required>

                            <button type="submit">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="delete_record.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    <?php } ?>
                </ul>
            </section>
        <?php } else if ($city || $newCity) { ?>
            <p>No results found.</p>
        <?php } ?>

    </header>
</main>
</body>
</html>
