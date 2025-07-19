<?php
// ⚠️ EDIT THESE VALUES ⚠️
define('DB_HOST', 'localhost');     // Usually "localhost"
define('DB_NAME', 'ellie_rms');     // Your database name
define('DB_USER', 'root');          // Database username
define('DB_PASS', 'password123');   // Database password

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
