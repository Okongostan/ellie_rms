<?php
session_start();

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit;
    }
}

function require_admin_role() {
    require_login();
    if ($_SESSION['user_role'] !== 'admin') {
        die("Access denied. Admin privileges required.");
    }
}
?>
