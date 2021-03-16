<?php
date_default_timezone_set('America/Caracas');


    $_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    try{
        $statament = $_conexion->prepare('SELECT `date` FROM craft LIMIT 5');
        $statament->execute();
        $busqueda= $statament->fetchAll(PDO::FETCH_ASSOC);
       # print_r($busqueda);

        //Obtener tiempo transcurrido
        $fechaPasado=new DateTime($busqueda[0]['date']);
       #$fechaPasado=new DateTime('now');
        sleep(5);
        $fechaPresente = new DateTime("now");
        $fechaBuscada= $fechaPresente->diff($fechaPasado);
        $f3= $fechaBuscada->format('%d - %H:%i:%s');

        $f1= $fechaPresente->format('Y-m-d H:i:s');
        $f2= $fechaPasado->format('Y-m-d H:i:s');

        echo "$f3 ---> ( $f1 - $f2) ";


    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }


?>