<?php
session_start();
require_once '../includes/db.php'; 

if (!$conn) {
    die("Database connection failed.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
    // 1. Sanitize Inputs
    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    // Generating a unique order number string
    $order_no_str = "ORD-" . strtoupper(substr(md5(time()), 0, 6));
    $order_details = "";

    // 2. Loop through session to build the Order Summary
    foreach ($_SESSION['cart'] as $id => $qty) {
        $id = mysqli_real_escape_string($conn, $id);
        $res = mysqli_query($conn, "SELECT item_name FROM products WHERE id = '$id'");
        $item = mysqli_fetch_assoc($res);
        
        // Example: "Bento Cake (x2), Classic Fudge (x1)"
        $order_details .= $item['item_name'] . " (x" . $qty . "), ";
    }

    // Add Delivery Info to details
    $order_details .= " | Area: " . $location . " | Address: " . $address;

    // 3. Save into database FIRST
    $sql = "INSERT INTO orders (order_no, name, details, whatsapp, status) 
            VALUES ('$order_no_str', '$name', '$order_details', '$whatsapp', 'Pending')";

    if (mysqli_query($conn, $sql)) {
        // 4. Get the last Auto-Increment ID
        $last_id = mysqli_insert_id($conn); 
        
        // 5. Clear the cart
        unset($_SESSION['cart']); 
        
        // 6. Redirect to success page with the ID
        header("Location: success.php?order_no=" . $last_id);
        exit();
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
} else {
    header("Location: menu.php");
    exit();
}
?>