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
</head>
<body>
    <div>
        <?php foreach($products as $product):?>
            <h2><?=$product['name']?></h2>
            <p><?=$product['description']?></p>
            <p><?=$product['price']?></p>

            <form method="POST" action="addToCart.php">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit">Add to cart</button>
            </form>
        <?php endforeach;?>
    </div>
    
</form>
</body>
</html>
