<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "bukutamu";

try {
    $db = new PDO("mysql:host=$hostname;dbname=$database_name;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
