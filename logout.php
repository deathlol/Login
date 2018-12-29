<?php 
	//Inicio de sesión en php
	session_start();
	//Libera las variables de sesión
	session_unset();
	//Destruye toda la información de la sesión
	session_destroy();
	// Redirecciona a index.php
	header('Location: index.php'); 
?>