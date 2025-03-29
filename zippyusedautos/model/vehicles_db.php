<?php
function get_vehicles($make_id = null, $type_id = null, $class_id = null, $sort_price = null, $sort_year = null) {
    global $db;
    
    $query = "SELECT v.*, m.makeName, t.typeName, c.className
              FROM vehicles v
              JOIN makes m ON v.makeID = m.makeID
              JOIN types t ON v.typeID = t.typeID
              JOIN classes c ON v.classID = c.classID";

    $conditions = [];
    $params = [];

    if ($make_id) {
        $conditions[] = "v.makeID = :make_id";
        $params[':make_id'] = $make_id;
    }
    if ($type_id) {
        $conditions[] = "v.typeID = :type_id";
        $params[':type_id'] = $type_id;
    }
    if ($class_id) {
        $conditions[] = "v.classID = :class_id";
        $params[':class_id'] = $class_id;
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Apply sorting based on user selection
    $orderBy = [];
    if ($sort_price) {
        if ($sort_price === 'price_desc') {
            $orderBy[] = "v.price DESC";
        } elseif ($sort_price === 'price_asc') {
            $orderBy[] = "v.price ASC";
        }
    }
    if ($sort_year) {
        if ($sort_year === 'year_desc') {
            $orderBy[] = "v.year DESC";
        } elseif ($sort_year === 'year_asc') {
            $orderBy[] = "v.year ASC";
        }
    }

    if (!empty($orderBy)) {
        $query .= " ORDER BY " . implode(", ", $orderBy);
    }

    $statement = $db->prepare($query);
    foreach ($params as $key => $val) {
        $statement->bindValue($key, $val);
    }
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();

    return $vehicles;
}

function add_vehicle($year, $model, $price, $make_id, $type_id, $class_id) {
    global $db;
    $query = "INSERT INTO vehicles (year, model, price, makeID, typeID, classID)
              VALUES (:year, :model, :price, :make_id, :type_id, :class_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_vehicle($vehicle_id) {
    global $db;
    
    $query = 'DELETE FROM vehicles WHERE vehicleID = :vehicle_id';  // Ensure 'vehicleID' is used instead of 'ID'
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_vehicles_filtered($make_id, $type_id, $class_id, $sort_price = null, $sort_year = null) {
    global $db;
    $query = "SELECT vehicles.*, makes.makeName, types.typeName, classes.className 
              FROM vehicles
              INNER JOIN makes ON vehicles.makeID = makes.makeID
              INNER JOIN types ON vehicles.typeID = types.typeID
              INNER JOIN classes ON vehicles.classID = classes.classID
              WHERE 1 = 1"; // Base query

    if ($make_id) { $query .= " AND vehicles.makeID = :make_id"; }
    if ($type_id) { $query .= " AND vehicles.typeID = :type_id"; }
    if ($class_id) { $query .= " AND vehicles.classID = :class_id"; }

    // Sorting Logic - Fix Price Sorting
    $order_by = [];
    
    if ($sort_price) {
        if ($sort_price === 'price_asc') {
            $order_by[] = "vehicles.price ASC";
        } elseif ($sort_price === 'price_desc') {
            $order_by[] = "vehicles.price DESC";
        }
    }
    
    if ($sort_year) {
        if ($sort_year === 'year_asc') {
            $order_by[] = "vehicles.year ASC";
        } elseif ($sort_year === 'year_desc') {
            $order_by[] = "vehicles.year DESC";
        }
    }
    
    if (!empty($order_by)) {
        $query .= " ORDER BY " . implode(", ", $order_by);
    } else {
        $query .= " ORDER BY vehicles.price DESC"; // Default sorting (optional)
    }

    $statement = $db->prepare($query);
    if ($make_id) { $statement->bindValue(':make_id', $make_id, PDO::PARAM_INT); }
    if ($type_id) { $statement->bindValue(':type_id', $type_id, PDO::PARAM_INT); }
    if ($class_id) { $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT); }
    
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    
    return $vehicles;
}

function get_vehicle_by_id($vehicle_id) {
    global $db;
    $query = "SELECT v.*, m.makeName, t.typeName, c.className 
              FROM vehicles v
              JOIN makes m ON v.makeID = m.makeID
              JOIN types t ON v.typeID = t.typeID
              JOIN classes c ON v.classID = c.classID
              WHERE v.vehicleID = :vehicle_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $vehicle = $statement->fetch();
    $statement->closeCursor();
    
    return $vehicle;
}
function update_vehicle($vehicle_id, $year, $model, $price, $make_id, $type_id, $class_id) {
    global $db;
    $query = "UPDATE vehicles 
              SET year = :year, model = :model, price = :price, makeID = :make_id, typeID = :type_id, classID = :class_id 
              WHERE vehicleID = :vehicle_id";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

?>

