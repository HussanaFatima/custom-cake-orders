<?php
require_once __DIR__.'/includes/db.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: public/order.php");
    exit;
}

// 1. Define all variables first
$orderNo    = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
$name       = $_POST['name'];
$whatsapp   = $_POST['whatsapp'];
$category   = $_POST['category'];
$details    = $_POST['details'];
$event_date = $_POST['event_date'];
$status     = "Pending"; // Defined BEFORE binding
$imageName  = "";


// 2. Handle Image Upload with Backend Validation
if (!empty($_FILES['image']['name'])) {
    $fileSize = $_FILES['image']['size']; // Size in bytes
    $fileType = $_FILES['image']['type']; // Mime type
    $maxSize = 2 * 1024 * 1024; // 2MB in bytes
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    // CHECK 1: Is the file too big?
    if ($fileSize > $maxSize) {
        die("Error: File is too large. Max limit is 2MB.");
    }

    // CHECK 2: Is it actually an image?
    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Only JPG and PNG images are allowed.");
    }

    // If checks pass, move the file
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imageName = time() . '_' . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/cakes/' . $imageName);
}
    
    // Path: root/uploads/cakes/
    $targetPath = __DIR__ . '/uploads/cakes/' . $imageName;
    
    move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);


// 3. Prepare and Bind
$stmt = $conn->prepare("
    INSERT INTO orders 
    (order_no, name, whatsapp, category, details, event_date, image, status)
    VALUES (?,?,?,?,?,?,?,?)
");
// Example Backend Validation
if(strlen($whatsapp) < 10) {
    die("Invalid WhatsApp number format.");
}

$allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
if(!in_array($_FILES['image']['type'], $allowed_types)) {
    die("Only JPG and PNG images are allowed.");
}
// Now $status exists and can be bound
$stmt->bind_param(
    "ssssssss",
    $orderNo, $name, $whatsapp, $category, $details, $event_date, $imageName, $status
);

if($stmt->execute()){
    // Redirect to the success page and pass the Order Number via URL
    header("Location: public/success.php?ono=" . urlencode($orderNo));
    exit;
} else {
    echo "Database Error: " . $stmt->error;
}
?>