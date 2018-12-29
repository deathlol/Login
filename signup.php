<?php
	//Requisición de datos desde database.php 
	require 'database.php';

	$message = '';
	// Revisa que los datos que se reciben del formulario no sean datos vacíos
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$sql = "INSERT INTO users (email,password) VALUES (:email, :password)";
		$stmt = $conn -> prepare($sql);
		$stmt -> bindParam(':email',$_POST['email']); 
		$contrasena = password_hash($_POST['password'],PASSWORD_BCRYPT);
		$stmt -> bindParam(':password',$contrasena);
		// Se crean mensajes diferentes para diferentes situaciones 
		if ($stmt->execute()) {
			$message = 'Se ha registrado el usuario exitosamente';
		} else {
			$message = 'Ocurrio un error';
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
	<?php 
		//Utiliza un módulo o sección para complementar la página
		require 'partials/header.php';
	?>	
	<!--Muestra un mensaje dependiendo si ocurrió un error o no surgió ningún problema -->
	<?php 
		if (!empty($message)):
	?>
			<p><?= $message ?></p>
	<?php endif; ?>
	<h1>Regístrese</h1>
	<span>o <a  href="login.php"><strong>Inicie sesión</strong></a></span>
	<div class="formulario">
		<!-- Formulario para registrar a un usuario -->
		<form action="signup.php" method="post">
			<input type="text" name="email" placeholder="Correo electronico...">
			<input type="password" name="password" placeholder="************">
			<input type="submit" name="Entrar">
		</form>
	</div>
</body>
</html>