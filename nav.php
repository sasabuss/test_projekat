<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])): ?>
    <nav style="margin-bottom: 20px;">
        <a href="dashboard.php">Home</a> |
        <a href="products.php">Products</a> |
        <a href="cart.php">Cart</a> |
        <a href="products.php">View all products</a> |
        <a href="addProduct.php">Add your product</a> |
    </nav>
<?php endif; ?>