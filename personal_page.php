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
	<title><?php echo $_SESSION['NOMBRE']?></title>
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
			
			</main>
			<section class="screen">
				<img src="imagenes/void.png" alt="thumb" >

				<h4 class="title-craft">Lorem Ipsum</h4>

				<header class="user">
					<picture>
						<img src="imagenes/void.png" alt="">
					</picture>
					<article class="iden">
						<span class="user-name">
							Lorem Ipsum
						</span>
					</article>
				</header>

				<p class="description">
					Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus consequuntur et dolore suscipit cumque commodi culpa ratione volupta
				</p>
				</section>

		</main>
		<aside class="contactos">
		<?php
				$_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
				try{
					$statament = $_conexion->prepare('SELECT * FROM users ');
					$statament->execute();
					$busqueda= $statament->fetchAll(PDO::FETCH_ASSOC);
					#print_r($busqueda);
					for ($i=0; $i < count($busqueda); $i++) {
						if(!($busqueda[$i]['id-users']==$_SESSION['ID'])){
						echo '<div class="user"><img src="imagenes/void.png" alt="perfil"><p class="nombre">'.$busqueda[$i]['name'].'</p></div>';

						}
					}

				}catch(PDOException $e){
					echo "Error:".$e->getMessage();
				}


		?>


		</aside></div>
		<script type="text/javascript" src="JS/axios.min.js"></script>
		<script type="text/javascript" src="JS/personal_page.js"></script>
</body>
</html>

<?php
//rgba(106, 189, 145, 0.87)
?>
