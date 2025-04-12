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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (!isset($_POST['name']) || empty($_POST['name'])) {
            die("You must enter name of product");
        }
    
        if (!isset($_POST['description'])) {
            die("You must enter description of product");
        }
    
        if (!isset($_POST['price']) || empty($_POST['price'])) {
            die("You must enter price of product");
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
            echo "Proizvod je uspešno dodat!";
        } else {
            echo "Greška pri dodavanju proizvoda.";
        }
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "POST">
        <input type="text" name="name" placeholder= "Name" required>
        <input type ="number" name="price" placeholder="Price" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit">Add product</button>
    </form>
</body>
</html>

