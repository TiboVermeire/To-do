<?php
session_start();

// Controleer of de gebruiker is ingelogd, anders doorverwijzen naar de inlogpagina
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Home Page!</h1>
    <a href="lists.php">Go to lists </a>

    <a href="logout.php">Logout</a>
</body>
</html>
