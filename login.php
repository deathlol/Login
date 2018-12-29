<?php 
	//Inicio de sesión en php
	session_start();
	//Comprueba si se ha iniciado sesión 
	if (isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}
	//Requisición de datos desde database.php 
	require 'database.php';
	//Comparo los datos del formulario con los de la base de datos
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$records = $conn -> prepare('SELECT id_user, email, password FROM users WHERE email=:email');
		$records -> bindParam('email',$_POST['email']);
		$records -> execute();
		$results = $records -> fetch(PDO::FETCH_ASSOC);

		$message = '';
		// Asigno diferentes acciones dependiendo de los resultados
		if (count($results) > 0 && password_verify($_POST['password'],$results['password'])) {
			$_SESSION['user_id'] = $results['id_user'];
			header('Location: index.php');
		} else {
			$message = 'Los datos no coinciden';
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Inicio de sesión</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>	
	<?php 
	//Utiliza un módulo o sección para complementar la página
		require 'partials/header.php';
	?>	
	<h1>Iniciar sesión</h1>
	<span>o <a  href="signup.php"><strong>Registrece</strong></a></span>
	<?php if(!empty($message)): ?>
		<!--Muestra un mensaje en pantalla si hay un error-->
		<p><?= $message ?></p>
	<?php endif; ?>
	<!-- Formulario para iniciar sesión -->
	<div class="formulario">
		<form action="login.php" method="post">
			<input type="text" name="email" placeholder="Correo electronico...">
			<input type="password" name="password" placeholder="************">
			<input type="submit" name="Entrar">
		</form>
	</div>
</body>
</html>