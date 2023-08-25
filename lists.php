<?php
session_start();
require_once 'src/to-do/framework/Db.php'; // Het juiste pad naar je Db.php-bestand
$conn = ToDo\Framework\Db::getConnection();

// Haal de gebruikers_id op uit de sessie (vervang "user_id" door de juiste sleutel)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query om lijstgegevens op te halen
    $query = "SELECT * FROM lists WHERE user_id = :user_id"; 

    // Voer de query uit en haal het resultaat op
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Gebruiker niet ingelogd.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do Lijsten</title>
</head>
<body>
    <h1>To-Do Lijsten</h1>
    <a href="add_list.php">Toevoegen</a>
    <ul>
        <?php
        foreach ($result as $row) {
            echo "<li><a href='tasks.php?lists_id={$row['id']}'>{$row['list_name']}</a></li>";
        }
        ?>
    </ul>
</body>
</html>
