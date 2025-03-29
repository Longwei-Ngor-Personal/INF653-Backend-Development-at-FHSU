<?php
$dsn = 'mysql:host=localhost;dbname=zippyusedautos';
$username = 'root'; 
$password = ''; 

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
    exit();
}
?>
