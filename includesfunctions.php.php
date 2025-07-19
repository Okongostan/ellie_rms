<?php
function log_activity($action) {
    global $pdo;
    $pdo->prepare("INSERT INTO activity_logs (user_id, action, ip_address) VALUES (?, ?, ?)")
       ->execute([
           $_SESSION['user_id'],
           $action,
           $_SERVER['REMOTE_ADDR']
       ]);
}
?>
