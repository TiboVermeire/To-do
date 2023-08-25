<?php
session_start();
require_once 'src/to-do/framework/Db.php'; // Het juiste pad naar je Db.php-bestand
$conn = ToDo\Framework\Db::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $list_name = $_POST['list_name'];
    $user_id = $_SESSION['user_id']; // Haal gebruikers_id uit de sessie

    // Bereken de huidige datum en tijd
    $date_time = date('Y-m-d H:i:s');

    // Query om een nieuwe lijst toe te voegen
    $query = "INSERT INTO lists (list_name, user_id, date_time) VALUES (:list_name, :user_id, :date_time)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':list_name', $list_name);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':date_time', $date_time);

    if ($stmt->execute()) {
        echo "Lijst is succesvol toegevoegd!";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de lijst.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Lijst Toevoegen</title>
</head>
<body>
    <h1>Nieuwe Lijst Toevoegen</h1>
    <a href="lists.php">Terug naar Lijsten</a>
    <form action="add_list.php" method="post">
        <label for="list_name">Naam van de lijst:</label>
        <input type="text" name="list_name" required>
        <button type="submit">Lijst Toevoegen</button>
    </form>
    <br>
   
</body>
</html>
