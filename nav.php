<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])): ?>
    <nav style="margin-bottom: 20px;">
        <a href="dashboard.php">Home</a> |
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
    </nav>
<?php endif; ?>