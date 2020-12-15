<?php
session_start();
$_SESSION=array();
header("content-type: application/json");

$_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$data = json_decode(file_get_contents("php://input"),true);

$_nombre=trim(filter_var($data['_nombre'],FILTER_SANITIZE_STRING));
$_pass = hash('sha512',$data['_password']);
if(empty($_nombre) || empty($_pass)){
    $_sms["user"]='usuario  o contraseña invalida';
    
        
}else{
    try{
    $statament = $_conexion->prepare('SELECT ID, NOMBRE, NICK, PASSWORD from usuarios WHERE NOMBRE =:nombre limiT 1');
    $statament->execute(array(':nombre'=>$_nombre));
    $busqueda = $statament->fetch();
    if ($busqueda== false){
        $_sms["user"]='usuario no existe';
        echo  json_encode($_sms);

    }else{
        
        if($busqueda['PASSWORD']==$_pass){
        
            $_SESSION['ID']=$busqueda['ID'];
            $_SESSION['NOMBRE']=$busqueda['NOMBRE'];
            $_SESSION['NICK']=$busqueda['NICK'];
            $_sms['url']="personal_page.php";
            echo json_encode($_sms);
        }else{
            $_sms["pass"]='usuario  o contraseña incorrectos';
            echo json_encode($_sms);
        }
    }

}catch(PDOException $e){
    echo "Error:".$e->getMessage();
}
}




?>