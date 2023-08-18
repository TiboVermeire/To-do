<?php
if (!empty($_POST)) {
    // Gegevens uit formulier halen
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Wachtwoord hashen voordat het wordt opgeslagen in de database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $conn = new PDO("mysql:host=localhost;dbname=ToDo", "root", "root");
    $statement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $statement->bindValue(":username", $username);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":password", $hashedPassword); // Gebruik hier het gehashte wachtwoord
    $statement->execute();

    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="ToDoRegister">
		<div class="form">
			<div class="form-left"></div>
			<form class="form-right" action="" method="post">
				<h2 class="form-title">Create Your Account</h2>
				<h3 class="form-subtitle">Please enter your credentials to create your account</h2>


				<?php if( isset($error) ):?>
					<div class="form__error">
						<?php echo $error; ?>
					</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" required>	
					<div id="username-availability" class="availability"></div>
				</div>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
					<div id="email-availability" class="availability" required></div>
				</div>

				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required>
				</div>

				<div class="form__field">
					<input type="submit" value="Sign Up" class="btn btn--primary">	
				</div>
			</form>
		</div>
	</div>
</body>
</html>