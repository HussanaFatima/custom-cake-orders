<?php

require_once '../includes/auth.php'; 
require_once '../includes/db.php';


if (!isset($_POST['id'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$id = intval($_POST['id']);


$query = "DELETE FROM orders WHERE id = $id";
mysqli_query($conn, $query);


header("Location: admin_dashboard.php?msg=deleted");
exit;
?>