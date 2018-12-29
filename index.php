<?php
	//Inicio de sesión en php
	session_start();
	//Requisición de datos desde database.php 
	require 'database.php';
	// Identifica si se ha iniciado sesión para mostrar diferentes datos en pantalla 
	if (isset($_SESSION['user_id'])) {
		$records = $conn -> prepare('SELECT id_user, email, password FROM users WHERE id_user = :user_id');
		$records -> bindParam(':user_id', $_SESSION['user_id']);
		$records -> execute();
		$results = $records -> fetch(PDO::FETCH_ASSOC);

		$user = null;
		// Cuenta el numero de datos 
		if (count($results) > 0) {
			$user = $results;
		}
	}
		
?>

<!DOCTYPE html>
<html leng="es">
<head>
	<meta charset="utf-8">
	<title>INICÍO</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
	<!--Muestra datos diferentes dependiendo de la comprobación realizada anteriormente-->
	<?php if(!empty($user)): ?>
		<div class="titulo">
			<h1>Bienvenido <?= $user['email']; ?> </h1>
		</div>
		 Se ha unido satisfactoriariamente <br><br><br>
		<div class="links">
			<a class="links" href="logout.php">Salir</a>
		</div>
	<?php else: ?>
		<div class="titulo">
			<h1>Por favor inicie sesión o regístrese</h1>
		</div>
		<div class="links">
			<a href="login.php">Iniciar sesión</a> 
			<a href="signup.php">Registrarse</a>
		</div>
	<?php endif; ?>
</body>
</html>