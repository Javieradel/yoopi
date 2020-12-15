<?php
session_start();

/* if(!isset($_SESSION['NOMBRE'])){    
	header('location: iniciar_sesion.php');
	} */
header("content-type: application/json");


$_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$data = json_decode(file_get_contents("php://input"),true);
$data['data']= json_encode($data['data']);

$identificadorImagen='thumbs/creaciones/'.$_SESSION['ID'].'-'.$_SESSION['id_creacion'].'-'.$_SESSION['NICK'].'.gif';
try{
    $statament = $_conexion->prepare('UPDATE craft  SET `data` = :DATA WHERE `id-craft` = :id');
    $statament->execute(array(":DATA"=>$data['data'],':id'=>$_SESSION['id_creacion']));

    echo json_encode($arr['registo']="ok");
    $data['data']= json_decode($data['data']);
    generarImagen($identificadorImagen,$_SESSION['creacion-actual']['_dimension'],$data['data']);
    $rutaImagen= $_conexion->prepare('UPDATE craft SET thumb = :ruta WHERE `id-craft` = :id');
    $rutaImagen->execute(array(':ruta'=>$identificadorImagen,':id'=>$_SESSION['id_creacion']));
    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }
function generarImagen($idenImagen,$dimension,$data){
        //obtener dimension
        $dimension_= explode(' x ',$dimension);
        //obtener colores
        //$busqueda['DATA'];//es un array que contiene arrays
        //$_data es la totalidad de los colores
        $_data=array(); 
        //$_fila es el array con las filas
        $_fila=array();
        //$celdas es el array con las celdas
        $_celdas=array();
        //$valor es el trio para el color
        try{
        for($fila=0;$fila<$dimension_[0];$fila++){
        //entrar en celdas
        for($celda=0;$celda<$dimension_[1];$celda++){
        $valor= $data[$fila][$celda];
        $valor= str_replace('rgb','',$valor);
        $valor= str_replace('(','',$valor);
        $valor= str_replace(')','',$valor);
        $valor= explode(',',$valor);
        $_celdas[$celda]=$valor;
        }
        $_fila[$fila]=$_celdas;
        } 
        $height= $dimension_[0]*10;
        $width=$dimension_[1]*10; 

        $lienzo= imagecreatetruecolor($height,$width);
        $white= imagecolorallocate($lienzo,255,255,255);
        $black= imagecolorallocate($lienzo,0,0,0);
        imagefill($lienzo,0,0,$black);
        for($fila=0;$fila<$dimension_[0];$fila++){
        //entrar en celdas

        //posicion Inicial = posicion Final de pixel anterior
        $posicion_1=array();
        //posicion final = posicion inicial + ancho de pixel
        $posicion_2=array();

        for($celda=0;$celda<$dimension_[1];$celda++){
        //color del pixel a dibujar
        $posicion_1['x']=$celda*10;$posicion_1['y']=$fila*10;

        $color= imagecolorallocate($lienzo,$_fila[$fila][$celda][0], $_fila[$fila][$celda][1], $_fila[$fila][$celda][2]);
        $posicion_2['x']=$posicion_1['x']+10;$posicion_2['y']=$posicion_1['y']+10;
        imagefilledrectangle($lienzo,$posicion_1['x'],$posicion_1['y'],$posicion_2['x'],$posicion_2['y'],$color);

        }

        } 

        //------representar
        imagegif($lienzo,$idenImagen);
        //image destruir
        imagedestroy($lienzo);  
        }catch(Exception $e){
        echo "Error:".$e->getMessage();
        }}
?>
