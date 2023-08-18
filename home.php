<?php
session_start();

// Controleer of de gebruiker is ingelogd, anders doorverwijzen naar de inlogpagina
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Voer andere acties uit voor de homepagina hier

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
    <!-- Voeg de inhoud van de homepagina hier toe -->

    <a href="logout.php">Logout</a>
</body>
</html>
