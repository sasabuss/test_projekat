

<?php
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    if (!isset($_SESSION['user'])) {
        echo "<p>Morate se prijaviti da biste pristupili ovoj stranici.</p>";
        echo '<a href="login.php"><button>Prijavi se</button></a>';
        exit;
    }
?>


<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Početna</title>
</head>
<body>

<h1>Dobrodošao!</h1>

<a href="logout.php">Logout</a>

</body>
</html>