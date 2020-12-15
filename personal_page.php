<?php

	session_start();	
	if(!isset($_SESSION['NOMBRE'])){    
	header('location: iniciar_sesion.php');
	}



?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet"type="text/css" href="estilos/fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="estilos/personal_page.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta lang="es">
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png">
	<title><?php echo $_SESSION['NICK']?></title>
</head>
<body>
			<header class="contededor">
			<h1 id="titulo">Yoopi </h1>
			</header>
	<div class="app">
		<aside class="infPersonal">
			<div class="wrapper_portada"><picture class="bg">
				<img src="portadas/"alt="Portada">
			</picture></div>
			<picture class="usuario">
				<img src="perfiles/default.jpg">
			</picture>
			<article class="menu">
			<div class="mnuItem"><p><li class="fas fa-user "></li><span>Perfil</span></p></div>
          <div class="mnuItem"><p><li class="fas fa-lock"></li><span>Seguridad</span></p></div>
          <div class="mnuItem"><p><li class="fas fa-address-book"></li><span>Contactos</span></p></div>
          <div class="mnuItem"><p><li class="fas fa-power-off"></li><span>Salir</span></p></div>
          <footer>
				<footer>
			<a href="#">Yoopi &copy;</a> 
			<a href="index.php">Inicio</a>
			<a href="#">Terminos de uso</a>
		</footer>
			</article>
		</aside>
		
		<main>
			<main class="contenedor-menu">
			
			</main><!-- 
			<section class="screen">
				<picture class="mostrador">
				
			
				
				<h4 class="title">Lorem Ipsum</h4>
				<img src="imagenes/void.png" alt="thumb" >
				
				<p class="description">
					Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus consequuntur et dolore suscipit cumque commodi culpa ratione volupta
				</p>
				</picture>
				</section>
				<section class="lista">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<img src="imagenes/void.png" alt="thumb" class="thumb">
					<div class="btn">Atras</div>
					<div class="btn">Siguiente</div>
			</section> -->
		</main>
		<aside class="contactos">
		<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
		<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
		    <div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
		    <div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
			<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">Juan Esutaquio</p></div>
		</aside></div>
		<script type="text/javascript" src="JS/axios.min.js"></script>
		<script type="text/javascript" src="JS/personal_page.js"></script>
</body>
</html>

<?php
//rgba(106, 189, 145, 0.87)
?>
