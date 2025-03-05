<?php
$dsn ="mysql:host=localhost; dbname=assignment_tracker";
$username = 'root';
$password = '1qaz2wsx';

try{
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e){
    error_log($e->getMessage());
    die("Database")
}
?>