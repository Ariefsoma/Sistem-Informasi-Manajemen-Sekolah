<?php
$dsn = 'mysql:host=127.0.0.1;port=3306';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `sims_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "DB created\n";
} catch (PDOException $e) {
    echo "DB create failed: " . $e->getMessage() . "\n";
    exit(1);
}
