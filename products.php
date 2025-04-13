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

    require_once "Modeli/Database.php";
    require_once "Modeli/Product.php";

    $db = new Database();
    $conn = $db->getConnection();
    $product = new Product($conn);
    $products = $product->getAllProducts();

    include 'nav.php';

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    .product-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .product-card {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 16px;
        width: 30%;
        box-sizing: border-box;
        background-color: #f9f9f9;
    }

    .product-card h2 {
        margin-top: 0;
    }
</style>

</head>
<body>
<div class="product-grid">
    <?php foreach($products as $product): ?>
        <div class="product-card">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <p><?= $product['price'] ?>€</p>
            <form method="POST" action="addToCart.php">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

    
</form>
</body>
</html>
