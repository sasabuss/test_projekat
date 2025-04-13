<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    echo "<p>You must be logged in to access this page.</p>";
    echo '<a href="login.php"><button>Log in</button></a>';
    exit;
}

include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<h1>Welcome!</h1>

<a href="logout.php">Logout</a>

</body>
</html>
