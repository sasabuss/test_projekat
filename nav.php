<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])): ?>
    <nav style="margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="dashboard.php">Home</a> |
                <a href="products.php">View all products</a> |
                <a href="addProduct.php">Add your product</a> |
                <a href="myProducts.php">My products</a> |
                <a href="myOrders.php">My orders</a> |
                <a href="cart.php">Cart</a>
            </div>
            <div>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
<?php endif; ?>