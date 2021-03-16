<?php
session_start();	
if(!isset($_SESSION['NOMBRE'])){    
header('location: iniciar_sesion.php');
}

header("content-type: application/json");

    
if($_SERVER['REQUEST_METHOD']== 'POST'){
    $data = json_decode(file_get_contents("php://input"),true);
    $data['_titulo']=trim(filter_var($data['_titulo'],FILTER_SANITIZE_STRING));
    $data['_description']=trim(filter_var($data['_description'],FILTER_SANITIZE_STRING));
    $data['_dimension']=trim(filter_var($data['_dimension'],FILTER_SANITIZE_STRING));
 
    if(empty($data['_titulo']) || empty($data['_description']) || empty($data['_dimension'])){

        $sms['error']="Los campos no pueden estar vacios";
        echo json_encode($sms);
    }else{

    $_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    try{
        $statament = $_conexion->prepare('INSERT INTO craft VALUES (null,:AUTHOR,:TITLE,:DESCRIPTION, :SIZE, :DATA,NOW(),:thumb,null)');

        $statament->execute(array(':AUTHOR'=>$_SESSION['NICK'],':TITLE'=>$data['_titulo'],":DESCRIPTION"=>$data['_description'],":SIZE"=>$data['_dimension'],":DATA"=>'',':thumb'=>'empty'));
        $_SESSION['id_creacion']= $_conexion->lastInsertId();
    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }
    $_SESSION['creacion-actual']= $data;
    $sms['estado']='ok';
    echo json_encode($sms);

}
}elseif ($_SERVER['REQUEST_METHOD']=='GET'){
    //mandar datos a nueva pizarra
    $arr = $_SESSION['creacion-actual'];
    $sms['titulo']=$arr['_titulo'];
    $sms['dimension']=$arr['_dimension'];
    $sms['author']=$_SESSION['NICK'];
    echo json_encode($sms); 
}

?>

