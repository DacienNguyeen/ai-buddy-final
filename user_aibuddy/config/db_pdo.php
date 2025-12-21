<?php
// config/db_pdo.php
$env = require __DIR__ . '/env.php';

try {
    $dsn = "mysql:host={$env['DB_HOST']};dbname={$env['DB_NAME']};charset=utf8mb4";
    $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Chatbot DB Connection Failed: " . $e->getMessage());
}
?>  