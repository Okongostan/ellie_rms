<?php
require_once '../includes/auth.php';
require_once '../includes/db_connect.php';

// Add new staff
if ($_POST['add_staff']) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role']; // 'staff', 'manager', 'admin'
    
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$username, $password, $role]);
}
?>

<h2>Staff Management</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Staff Username" required>
    <input type="password" name="password" placeholder="Temporary Password" required>
    <select name="role">
        <option value="staff">Regular Staff</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit" name="add_staff">Add Staff Member</button>
</form>
