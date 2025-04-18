<?php

    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }


    if(!isset($_SESSION['user']))
    {
        header("Location: login.php");
    }

    require_once "Models/Database.php";

    $db = new Database();
    $conn = $db->getConnection();

    $userId = $_SESSION['user']['id'];

    $sql =("SELECT orders.id, orders.product_id, orders.quantity, products.name, products.price
    FROM orders
    INNER JOIN products ON products.id = orders.product_id
    WHERE orders.user_id = $userId");


    $result = $conn->query($sql);

    $show = $result->fetch_all(MYSQLI_ASSOC);

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

<?php
    $total = 0;
    foreach ($show as $row) {
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        echo "<p>Name: {$row['name']}</p>";
        echo "<p>Quantity: {$row['quantity']}</p>";
        echo "<p>Price: {$row['price']} €</p>";
        echo "<p>Subtotal: {$subtotal} €</p><hr>";
    }
    ?>
    <p><strong>Total: <?= $total ?> €</strong></p>

    <form action="clearOrders.php" method="POST">
    <button type="submit">Clear order history</button>
    </form>
    </body>
</html>






