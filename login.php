<?php
require_once 'Models/Database.php';
require_once 'Models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$poruka = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $baza = new Database();
    $conn = $baza->getConnection();

    $user = new User($conn);
    $rezultat = $user->login($_POST['email'], $_POST['password']);

    if ($rezultat !== null && $rezultat !== true) {
        $poruka = $rezultat; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if (!empty($poruka)) : ?>
    <p><?= htmlspecialchars($poruka) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Log in</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>
