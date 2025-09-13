<?php

    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_SESSION['user']))
    {
        header("Location: login.php");
        exit();
    }

    if(!isset($_SESSION['cart']))
    {
        header("Location: products.php");
    }

    require_once "Models/Database.php";

    $db = new Database();
    $conn = $db->getConnection ();

    $userId = $_SESSION['user']['id'];

    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $productId = (int)$productId;
        $quantity = (int)$quantity;
    
        
        $query = "INSERT INTO orders (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
        $conn->query($query);
    }
    
    
    unset($_SESSION['cart']);
    include 'nav.php';
    
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order Confirmed</title>
    </head>
    <body>
        <h2>Your order was placed successfully!</h2>
        <a href="products.php">Continue shopping</a>
    </body>
    </html>

