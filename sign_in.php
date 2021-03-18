<?php

?>
<!DOCTYPE html>
<html>
<head lang="ES">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
	<meta charset="utf-8">
	<title>Registrate en Yoopi</title>
	<link rel="stylesheet" type="text/css" href="estilos/sign-in.css">
</head>
<body>
	<div class="Contenerdor">
		<header>
			<h1 id="titulo">Yoopi </h1>
		</header>
		<main>
			<picture><img src="Logo.png"></picture></br>
			<span>Bienvenido a Yoopi!!!</span>
			</br><span>Registrate es Gratis</span>
		<form name="inicio" method="POST" class="Formulario" id="form"action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
				
				<input id="usuario" type="text"  placeholder="Ingresa tu Nombre"name="Usuario"></br>

				<input type="email" placeholder="Ingresa tu Correo"name="correo"id="email"></br>

				<input type="email" placeholder="Confirma tu Correo"name="correoc" id="email2"></br>

				<input type="password" placeholder="Ingresa tu Contraseña"name="Key"id="pass"></br>
			
				<input type="password" placeholder="Verifica tu Contraseña"name="Keyc"id="pass2"></br>

				
				<section class="alertas">
					
				</section>
				<input type="button" name="Entrar" value="Registrarme" id='entrar' >
				</form></br>
		<p class='sms-sign'><a href="iniciar_sesion.php">Ya tengo una cuenta </a>
		</p></main>
		<footer>
			<a href="#">Yoopi &copy;</a> 
			<a href="index.php">Inicio</a>
			<a href="#">Terminos de uso</a>

		</footer>
	</div>
	<script type="text/javascript" src="JS/Manejo_data.js"></script>
	<script type="text/javascript" src="JS/axios.min.js"></script>
</body>
</html>
<?php

?>