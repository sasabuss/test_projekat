<?php
require_once 'Modeli/Database.php';
require_once 'Modeli/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$poruka = "";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $baza = new Database();
    $conn = $baza->getConnection();

    $user = new User($conn);
    $rezultat = $user->register($_POST['email'], $_POST['password']);

    if ($rezultat === true) {
        $poruka = "You have successfully registered!";
    } else {
        $poruka = $rezultat;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>

<h2>Registration</h2>

<?php if (!empty($poruka)) : ?>
    <p><?= $poruka ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button><br><br>
    <p>Already have an account?</p>
    <a href="login.php">Log in</a>
</form>

</body>
</html>

