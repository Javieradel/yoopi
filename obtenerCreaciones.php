<?php
session_start();	
if(!isset($_SESSION['NOMBRE'])){    
header('location: iniciar_sesion.php');
}

header("content-type: application/json");
    
if($_SERVER['REQUEST_METHOD']== 'GET'){
    $data = json_decode(file_get_contents("php://input"),true);
    $data['key']=trim(filter_var($data['_titulo'],FILTER_SANITIZE_STRING));
    $_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    try{
        $statament = $_conexion->prepare('SELECT * FROM creaciones WHERE AUTHOR=:author');
        $statament->execute(array(':author'=>$_SESSION['NICK']));
        $busqueda= $statament->fetchAll();
        echo json_encode($busqueda);
    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }
   
  
   
}
elseif (false){
    //mandar datos a nueva pizarra
    $arr = $_SESSION['creacion-actual'];
    $sms['titulo']=$arr['_titulo'];
    $sms['dimension']=$arr['_dimension'];
    $sms['author']=$_SESSION['NICK'];
    echo json_encode($sms); 
}

?>

