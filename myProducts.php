<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user']['id'];

require_once "Models/Database.php";

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM products WHERE user_id = '$userId'";
$result = $conn->query($sql);

$rows = [];
if ($result && $result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}

include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
</head>
<body>

<?php if (empty($rows)): ?>
    <p>No products to show</p>
<?php else: ?>
    <?php foreach($rows as $row): ?>
        <h1><?= htmlspecialchars($row['name']) ?></h1>
        <p><?= htmlspecialchars($row['description']) ?></p>
        <p><?= htmlspecialchars($row['price']) ?> €</p>
        <form method="POST" action="deleteProduct.php">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <button type="submit">Delete</button>
        </form>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
