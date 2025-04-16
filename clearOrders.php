<?php

    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_SESSION['user']))
    {
        header("Location: login.php");
    }

    require_once "Modeli/Database.php";

    $db = new Database();
    $conn = $db->getConnection();

    $userId = $_SESSION['user']['id'];

    $sql = ("DELETE FROM orders WHERE user_id = '$userId'");
    $conn->query($sql);

    header("Location: Products.php");

