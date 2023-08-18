<?php
session_start();

// Als de gebruiker al ingelogd is, leidt deze door naar de homepagina
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Controleer of er een inlogpoging is ingediend
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    $conn = new PDO("mysql:host=localhost;dbname=ToDo", "root", "root");
    $statement = $conn->prepare("SELECT id, password FROM users WHERE username = :username OR email = :email LIMIT 1");
    $statement->bindValue(":username", $usernameOrEmail);
    $statement->bindValue(":email", $usernameOrEmail);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Als de inloggegevens juist zijn, sla dan de gebruikerssessie op
        $_SESSION['user_id'] = $user['id'];

        // Na succesvolle inlog, leidt de gebruiker door naar de homepagina
        header("Location: home.php");
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam/e-mail of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="username_or_email">Username or Email:</label>
        <input type="text" id="username_or_email" name="username_or_email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
