<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Provera da li je poslat productId
if (!isset($_GET['productId']) || empty($_GET['productId'])) {
    header("Location: cart.php");
    exit;
}

$productId = $_GET['productId'];

// Provera da li korpa postoji i da li sadrži taj proizvod
if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
}

// Redirekcija nazad na korpu
header("Location: cart.php");
exit;
