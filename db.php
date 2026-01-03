<?php
$server = 'localhost';
$database = 'herald_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$server;dbname=$database;charset=utf8",
        $username,
        $password
    );

    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch associative arrays by default
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Server could not be connected: " . $e->getMessage());
}
?>
