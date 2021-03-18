<?php

$_conexion = new PDO('mysql:host=localhost; dbname=yoopi','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
try{
    $statament = $_conexion->prepare("SELECT * FROM creaciones WHERE AUTHOR='LolisGratis' AND ID=7");
    $statament->execute();
    $busqueda= $statament->fetch();
    $busqueda['DATA']=json_decode($busqueda['DATA']);
    
  
    }catch(PDOException $e){
        echo "Error:".$e->getMessage();
    }
//obtener dimension
$dimension= explode(' x ',$busqueda['SIZE']);
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
for($fila=0;$fila<$dimension[0];$fila++){
    //entrar en celdas
    for($celda=0;$celda<$dimension[1];$celda++){
        $valor= $busqueda['DATA'][$fila][$celda];
        $valor= str_replace('rgb','',$valor);
        $valor= str_replace('(','',$valor);
        $valor= str_replace(')','',$valor);
        $valor= explode(',',$valor);
        $_celdas[$celda]=$valor;
    }
    $_fila[$fila]=$_celdas;
} 
$height= $dimension[0]*10;
$width=$dimension[1]*10; 

$lienzo= imagecreatetruecolor($height,$width);
$white= imagecolorallocate($lienzo,255,255,255);
$black= imagecolorallocate($lienzo,0,0,0);
imagefill($lienzo,0,0,$black);
 for($fila=0;$fila<$dimension[0];$fila++){
    //entrar en celdas
    
    //posicion Inicial = posicion Final de pixel anterior
    $posicion_1=array();
    //posicion final = posicion inicial + ancho de pixel
    $posicion_2=array();

    for($celda=0;$celda<$dimension[1];$celda++){
        //color del pixel a dibujar
       $posicion_1['x']=$celda*10;$posicion_1['y']=$fila*10;

       $color= imagecolorallocate($lienzo,$_fila[$fila][$celda][0], $_fila[$fila][$celda][1], $_fila[$fila][$celda][2]);
       $posicion_2['x']=$posicion_1['x']+10;$posicion_2['y']=$posicion_1['y']+10;
       imagefilledrectangle($lienzo,$posicion_1['x'],$posicion_1['y'],$posicion_2['x'],$posicion_2['y'],$color);
       
    }
    
} 
//imagefilledrectangle($lienzo,X1,Y1,X2,Y2,color);
//dibujar imagen


//------representar
header("content-type:image/gif");
imagegif($lienzo);

//image destruir
imagedestroy($lienzo);  
}catch(Exception $e){
    echo "Error:".$e->getMessage();
}
?>