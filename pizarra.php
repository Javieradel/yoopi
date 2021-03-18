<?php
   
    session_start();	
    if(!isset($_SESSION['NOMBRE'])){    
    header('location: iniciar_sesion.php');
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilos/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="estilos/pizarra.css">
    <title>Creacion</title>
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
        <a href="#">Yoopi &copy;</a> 
        <a href="index.php">Inicio</a>
        <a href="#">Terminos de uso</a>
      </footer>
        </article>
      </aside
      >
<table id="_pizarra"></table>  

<div id="paleta">    
  <div class="monitor muestra">
  </div>
  
</div>

</div>
    <script type="text/javascript" src="JS/axios.min.js"></script> 
       <script src="JS/app-pizarra.js"></script>
        
</body>
</html>