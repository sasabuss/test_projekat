<?php

    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Your cart is empty.");
    }

    require_once "Models/Database.php";
    require_once "Models/Product.php";

    $db = new Database();
    $conn = $db->getConnection();

    $product_ids = array_keys($_SESSION['cart']);

    $ids_str = implode(',', $product_ids);

    $sql = "SELECT * FROM products WHERE id IN ($ids_str)";
    $result = $conn->query($sql);

    $products = [];
    
    if ($result && $result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    }

    $total = 0;

    include 'nav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
</head>
<body>

    <h2>Your Cart</h2>

    <?php foreach ($products as $product): 
        $id = $product['id'];
        $quantity = $_SESSION['cart'][$id];
        $price_eur = $product['price'] ;
        $subtotal = $price_eur * $quantity;
        $total += $subtotal;
    ?>

    <div style="margin-top: 10px;">
        <strong><?= htmlspecialchars($product['name']) ?></strong><br>
        Price: <?= number_format($price_eur, 2) ?> €<br>
        Quantity: <?= $quantity ?><br>
        Subtotal: <?= number_format($subtotal, 2) ?> €<br>
    </div>
    <a href="removeProduct.php?productId=<?= $product['id'] ?>">
    <button type="button">Remove</button> 
    </a>

    <a href="clearCart.php">
        <button type="button">Empty cart</button>
    </a>

    <?php endforeach; ?>

    <hr>
    <p><strong>Total: <?= number_format($total, 2) ?> €</strong></p>
    <form method="POST" action="order.php">
        <button type="submit">Order</button>
    </form>
</body>
</html>


