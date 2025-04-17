<?php

    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_SESSION['user']))
    {
        header("Location: login.php");
    }


    $userId = $_SESSION['user']['id'];

    require_once "Modeli/Database.php";


    $db = new Database();
    $conn = $db->getConnection();
    $sql = ("SELECT * FROM products WHERE user_id = '$userId'");

   $result = $conn->query($sql);

   
   
   if($result->num_rows > 0)
   {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
   }

   else 
   {
    echo "No products to show";
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

    <?php foreach($rows as $row): ?>
        <h1><?= $row['name']?></h1>
        <p><?= $row['description']?></p>
        <p><?= $row['price']?></p>
        <form method="POST" action="deleteProduct.php">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <button type="submit">Delete</button>
        </form>

    <?php endforeach; ?>


    
   </body>
   </html>
