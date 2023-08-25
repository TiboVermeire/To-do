<?php
session_start();
require_once 'src/to-do/framework/Db.php'; // Het juiste pad naar je Db.php-bestand
$conn = ToDo\Framework\Db::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task_name = $_POST['task_name'];
    $lists_id = $_POST['lists_id']; // Let op de wijziging van 'lists_id' naar 'list_id'

    // Query om een nieuwe taak toe te voegen aan een lijst
    $query = "INSERT INTO tasks (task_name, lists_id) VALUES (:task_name, :lists_id)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':task_name', $task_name);
    $stmt->bindParam(':lists_id', $lists_id);
    
    if ($stmt->execute()) {
        $_SESSION['added_task'] = true; // Sla op dat een taak is toegevoegd
        header("Location: tasks.php?lists_id=$lists_id"); // Ga terug naar takenpagina
        exit();
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de taak.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe Taak Toevoegen</title>
</head>
<body>
    <h1>Nieuwe Taak Toevoegen</h1>
    <form action="add_task.php" method="post">
        <input type="hidden" name="lists_id" value="<?php echo $_GET['lists_id']; ?>">
        <label for="task_name">Naam van de taak:</label>
        <input type="text" name="task_name" required>
        <button type="submit">Taak Toevoegen</button>
    </form>
    <br>
    <a href="tasks.php?lists_id=<?php echo $_GET['lists_id']; ?>">Terug naar Taken</a>
</body>
</html>
