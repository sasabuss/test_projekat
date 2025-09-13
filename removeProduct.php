<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET['productId']) || empty($_GET['productId'])) {
    header("Location: cart.php");
    exit;
}

$productId = $_GET['productId'];

if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
}


header("Location: cart.php");
exit;
