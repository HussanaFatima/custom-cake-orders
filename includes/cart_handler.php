<?php
session_start();

if (isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'add') {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]++;
        } else {
            $_SESSION['cart'][$id] = 1;
        }
    } 
    elseif ($action == 'remove') {
        unset($_SESSION['cart'][$id]);
    } 
    elseif ($action == 'decrease') {
        if ($_SESSION['cart'][$id] > 1) {
            $_SESSION['cart'][$id]--;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }

    header("Location: ../public/menu.php#product_" . $product_id);
header("Location: view_cart.php"); 
exit();
}