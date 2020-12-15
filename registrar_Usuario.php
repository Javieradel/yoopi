<?php

header("content-type: application/json");
$_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$data = json_decode(file_get_contents("php://input"),true);

$_sms=array();
// Validar campo Usuario
$_nombre=trim(filter_var($data['_nombre'],FILTER_SANITIZE_STRING));
if(empty($_nombre)){
        $_sms["sms_user"]=3;

    }else{
        try{
        $statament = $_conexion->prepare('SELECT * from users WHERE `name` =:nombre limiT 1');
        $statament->execute(array(':nombre'=>$_nombre));
        $busqueda = $statament->fetch();
        if ($busqueda!= false){
            $_sms["sms_user"]=0;
        }else{

            $_sms["sms_user"]="";

        }
    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }
    }

// validar email y comprobar uso
$_email = trim(filter_var($data['_email'],FILTER_SANITIZE_EMAIL));
if(empty($_email)){
        $_sms["sms_email"]=0;
    }else{
        try{
            $statament = $_conexion->prepare('SELECT * from users WHERE `email` =:email limiT 1');
            $statament->execute(array(':email'=>$_email));
            $busqueda = $statament->fetch();
            if ($busqueda!= false){
                $_sms["sms_email"]=1;
            }else{
                $_sms["sms_email"]="";
            }
        }catch(PDOException $e){
            echo "Error:".$e->getMessage();
        }
    }

//encriptar  password
 $_password= hash('sha512',$data['_password']);

 if(($_sms['sms_email'] && $_sms['sms_user'])== ''){
    try{
        $statament = $_conexion->prepare('INSERT INTO users  VALUES (null,:nombre,:email,:password,"")');
        $statament->execute(array(':nombre' => $_nombre,'email'=>$_email,':password'=> $_password));
        $_sms['registro']='OK';
        echo json_encode($_sms);
    }catch(PDOException $e){
            echo "Error:". $e->getMessage();
        
        }
    }else{
        $_sms['registro']='';
       echo json_encode($_sms);
       print_r($_sms);


    }
 


	


?>