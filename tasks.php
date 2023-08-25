<?php
session_start();
require_once 'src/to-do/framework/Db.php'; // Het juiste pad naar je Db.php-bestand
$conn = ToDo\Framework\Db::getConnection();


$lists_id = $_GET['lists_id'];

if (isset($_SESSION['added_task']) && $_SESSION['added_task']) {
    echo "Taak is succesvol toegevoegd!";
    unset($_SESSION['added_task']); // Verwijder de sessievariabele
}

// Query om taken van de specifieke lijst op te halen
$query = "SELECT * FROM tasks WHERE lists_id = :lists_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':lists_id', $lists_id);
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Taken</title>
</head>
<body>
    <h1>Taken</h1>
    <a href="lists.php">Terug naar Lijsten</a>
    
    <!-- Voeg knop toe om een nieuwe taak toe te voegen -->
    <a href="add_task.php?lists_id=<?php echo $lists_id; ?>">Nieuwe Taak Toevoegen</a>
    
    <!-- Toon lijst van taken -->
    <ul>
        <?php
        foreach ($tasks as $task) {
            echo "<li>{$task['task_name']}</li>";
        }
        ?>
    </ul>
</body>
</html>
