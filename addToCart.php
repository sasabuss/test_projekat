<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['product_id']) || empty($_POST['product_id'])) 
    {
        die("Product ID is required.");
    }

    $product_id = $_POST['product_id'];

    
    if (!isset($_SESSION['cart'])) 
        {
            $_SESSION['cart'] = [];
        }

    if (isset($_SESSION['cart'][$product_id])) 
        {
            $_SESSION['cart'][$product_id]++;
        } 
    else 
        {
            $_SESSION['cart'][$product_id] = 1;
        }

    
    header("Location: products.php");
    exit;
}

    

