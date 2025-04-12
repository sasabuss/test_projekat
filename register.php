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
        $poruka = "Uspešno ste se registrovali!";
    } else {
        $poruka = $rezultat;
    }
}
?>

<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
</head>
<body>

<h2>Registracija</h2>

<?php if (!empty($poruka)) : ?>
    <p><?= $poruka ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Lozinka" required><br><br>
    <button type="submit">Registruj se</button><br><br>
    <p>Imas nalog?</p>
    <a href="login.php">Uloguj se</a>
    
</form>



</body>
</html>


