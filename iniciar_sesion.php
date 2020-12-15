<?php 

    session_start();
    
    if(isset($_SESSION['NOMBRE'])){    
    header('location: personal_page.php');
  
}
?>
<!DOCTYPE html>
<html>
<head lang="ES">
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
	<title>Inicia Sesion en Yoopi</title>
	<link rel="stylesheet" type="text/css" href="estilos/login.css">
</head>
<body>
	<div class="Contenerdor">
		<header>
			<h1 id="titulo">Yoopi </h1>
		</header>
		<main>
			<picture><img src="Logo.png"></picture></br>
			<span>Bienvenido a Yoopi!!!</span>
			<form name="inicio" method="post" class="Formulario" ">
				
				<input id="usuario" type="text"  placeholder="Nombre"  name="Usuario" required>
				</br>
				<input id="pass" type="password" placeholder="Contraseña" name="Key" required></br>
				<section class="alertas">
					
				</section>
				<input type="button" name="Entrar" value="Entrar" id="entrar">
				</form>
			
		<p class='sms-sign'>No tienes cuenta? </br> Afiliate <a href="http://localhost/yoopi/sign_in.php">Ya</a>!!!</p>
		</main>
		<footer>
			<a href="#">Yoopi &copy;</a> 
			<a href="index.php">Inicio</a>
			<a href="#">Terminos de uso</a>

		</footer>
	</div>
<script type="text/javascript" src="JS/Validaciones.js"></script>
<script type="text/javascript" src="JS/axios.min.js"></script>


</body>
</html>
<?php


?>