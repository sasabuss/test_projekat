<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['product_id'])) {
    die("Invalid request.");
}

require_once "Models/Database.php";

$db = new Database();
$conn = $db->getConnection();

$userId = $_SESSION['user']['id'];
$productId = (int)$_POST['product_id'];

$sql = "DELETE FROM products WHERE id = $productId AND user_id = $userId";
$conn->query($sql);

header("Location: myProducts.php");
exit();
