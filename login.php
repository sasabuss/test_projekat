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
    $rezultat = $user->login($_POST['email'], $_POST['password']);

    if ($rezultat !== null && $rezultat !== true) {
        $poruka = $rezultat; // prikazuje poruku greške iz metode
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Prijava</title>
</head>
<body>

<h2>Prijava</h2>

<?php if (!empty($poruka)) : ?>
    <p><?= htmlspecialchars($poruka) ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Lozinka" required><br><br>
    <button type="submit">Prijavi se</button>
</form>

<p>Nemate nalog? <a href="register.php">Registrujte se</a></p>

</body>
</html>