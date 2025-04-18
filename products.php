<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once "Models/Database.php";

$db = new Database();
$conn = $db->getConnection();

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $escapedSearch = $conn->real_escape_string($search);
    $sql = "SELECT * FROM products WHERE name LIKE '%$escapedSearch%'";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
}

$products = [];
if ($result && $result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
}

include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

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

        form.search-form {
            text-align: center;
            margin: 20px;
        }

        form.search-form input {
            padding: 6px 10px;
            width: 200px;
        }

        form.search-form button {
            padding: 6px 10px;
        }
    </style>
</head>
<body>

<form class="search-form" method="GET" action="products.php">
    <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>

<div class="product-grid">
    <?php if (!empty($products)): ?>
        <?php foreach($products as $product): ?>
            <div class="product-card">
                <h2><?= $product['name'] ?></h2>
                <p><?= $product['description'] ?></p>
                <p><?= $product['price'] ?>€</p>
                <form method="POST" action="addToCart.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit">Add to cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

</body>
</html>
