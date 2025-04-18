<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once "Models/Database.php";
require_once "Models/Product.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['name']) || empty($_POST['name'])) {
        die("You must enter the product name.");
    }

    if (!isset($_POST['description'])) {
        die("You must enter the product description.");
    }

    if (!isset($_POST['price']) || empty($_POST['price'])) {
        die("You must enter the product price.");
    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user']['id'];

    $db = new Database();
    $conn = $db->getConnection();

    $product = new Product($conn);
    $rezultat = $product->addProducts($name, $description, $price, $user_id);

    if ($rezultat === true) {
        echo "Product added successfully!";
    } else {
        echo "Error while adding the product.";
    }
}

include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit">Add product</button>
    </form>
</body>
</html>
