<?php
require_once __DIR__ . '/../includes/auth.php'; 
require_once __DIR__ . '/../includes/db.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id     = intval($_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "UPDATE orders SET status='$status' WHERE id=$id";
    mysqli_query($conn, $query);
}

header("Location: admin_dashboard.php?msg=updated");
exit;
?>