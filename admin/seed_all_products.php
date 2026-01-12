<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../includes/db.php';

// Clean the table first
mysqli_query($conn, "TRUNCATE TABLE products");

$full_menu = [
    // [Category, Name, Price, Display]
    ['Cakes', 'Bento Cake', 1700, 'Rs. 1700'],
    ['Cakes', 'Fresh Cream Cake', 2000, 'Rs. 2000/pound'],
    ['Cakes', 'Red Velvet Cake', 2800, 'Rs. 2800/pound'],
    ['Shawarmas', 'Small Loaded Shawarma', 350, 'Rs. 350'],
    ['Shawarmas', 'Large Cheesy Shawarma', 490, 'Rs. 490'],
    ['Main Course', 'Chicken Chowmein', 1100, '1100 Rs'],
    ['Main Course', 'Marry Me Pasta', 1200, '1200 Rs'],
    ['Value Deals', 'Mini Trio (3 Small + Drink)', 1090, '1090 Rs'],
    ['Brownies', 'Classic Fudge (Box of 4)', 1200, '1200 Rs'],
    ['Tea Time Cakes', 'Plain Tea / Fruit Cake', 1000, '1000 Rs'],
    ['Banana Bread', 'Double Chocolate Loaf', 1500, '1500 Rs'],
    ['Add-Ons', 'Ranch Dip', 75, '75 Rs']
];

foreach ($full_menu as $item) {
    // FIXED: Changed 'base_price' to 'price' to match your screenshot
    // FIXED: Reordered columns to match your bind_param logic (item_name, category, price, price_display)
    $stmt = $conn->prepare("INSERT INTO products (item_name, category, price, price_display) VALUES (?, ?, ?, ?)");
    
    // Bind parameters: s = string, i = integer
    // Indexing: $item[1] is name, $item[0] is category, $item[2] is price, $item[3] is display
    $stmt->bind_param("ssis", $item[1], $item[0], $item[2], $item[3]);
    
    if (!$stmt->execute()) {
        echo "❌ Error: " . $stmt->error . "<br>";
    } else {
        echo "✅ Added: " . $item[1] . "<br>";
    }
}

echo "<h1>All Products Seeded!</h1>";
echo "<p><a href='.../public/menu.php'>Click here to see your Menu</a></p>";
?>