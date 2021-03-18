'use strict'
/* OBJETO CONFIG PERMITE TOMAR ACCION MIENTRAS SE ESPERA LA PETICION AJAX */
let config= {
  onDownloadProgress: progressEvent=>{

      document.body.style.cursor='wait';
          
      }
  }
  //---------------------------------------------------------------------------
  //ES EL UTILIZADO PARA EL MANEJO DE LA DATA USADA EN LA PIZARRA
  let infdata={
    titulo:"",
    nick:"",
    dimension:"",
    descripcion:""
  
  }
  //---------------------------------------------------------------------------
  //
function cargar_datos(){
  axios.get('asignar_espacio.php',config)
  .then((response)=>{
    //al terminar la  peticion, de ser correcta, se le asigna al objeto "infdata" los datos correspondientes
    //a la pizarra//
      infdata.titulo=response.data.titulo,
      infdata.nick=response.data.nick,
      infdata.dimension=response.data.dimension,
      infdata.descripcion=""
      infdata.dimension=infdata.dimension.split(' x ');
      document.body.style.cursor='default';
      document.title=infdata.titulo;
      //dibujamos la pizarra con la dimension obtenida de la peticion 
      dibujar_pizarra(infdata.dimension[0],infdata.dimension[1]);
      
      //activar pixeles

    var _pixel= document.querySelectorAll('.pixel');
    for (let i = 0; i< _pixel.length;i++){
    _pixel[i].addEventListener('click',(e)=>{
      //console.log(tam_Pincel);
        if(tam_Pincel > 0){
         //obtener origen
          let objetivo = e.target;
          let id_objetivo = parseInt(objetivo.id.substr(3));
          let padre = objetivo.parentNode;
          let id_padre = parseInt(padre.id.substr(3));
          //recorrer abajo
          //id de padre - el tamaño del pincel - padre  no cuenta desde 0
          // fp_min fila arriba desde el origen
          let fp_min= (id_padre - tam_Pincel);
          //si valor fp_min menor al numero de la fila1
          if (fp_min<1){
            fp_min=1;
          }
          //fp_max es el valor maximo desde la fila de origen
          let fp_max = (id_padre + tam_Pincel);
          //si valor fp_max mayor al numero de la ultima fila
          if (fp_max > pizarra.rows.length){
            fp_max= pizarra.rows.length;
          }
          //cp_min es el numero de celdas a recorrer
          let cp_min = (id_objetivo - tam_Pincel );
          if (cp_min<1){
            cp_min=1;
          }
          let cp_max= (id_objetivo+tam_Pincel)
          if (cp_max> pizarra.rows[id_padre-1].cells.length){
            cp_max=pizarra.rows[id_padre-1].cells.length;
          }
          for(let abajo=fp_min;abajo<=fp_max;abajo++){
           //presisar objetivos
            for(let celda = cp_min;celda<=cp_max;celda++){    
           //aplicar cambios
              pizarra.rows[abajo-1 ].cells[celda-1].style.backgroundColor=color_p;
            //console.log(pizarra.rows[abajo-1].cells[celda-1].id+"  " + pizarra.rows[abajo-1].cells[celda-1].className +"  "+ pizarra.rows[abajo-1].id);
            }
            }
}        
_pixel[i].style.backgroundColor=color_p;
        /* console.log(_pixel[i].id+' '+ color_p); */
    },false)    
}
//Activar Muestras
var _muestras = document.querySelectorAll('.muestra');
    for(let i=0;i<_muestras.length;i++){
    _muestras[i].addEventListener('click',()=>{color_p=_muestras[i].id;
        console.log('click en muestra:'+ _muestras[i].id);
        monitor.style.backgroundColor= _muestras[i].id;
        }
        ,false);
    }  
//obtener tamaño pincel
    console.log(response.data);
    return infdata; 
  }
    )
    .catch((error)=>{
      console.log('error\n'+error);});  
    }
let tam_Pincel= 1;
//crear opcion de background predeterminado
//crear paneles de colores personalizados
let pretBg='rgb(255,255,255);';
var color_p='#000000';//,herramienta_sel='lapiz';
var monitor = document.querySelector('.monitor');
var caja_paleta=document.querySelector('#paleta');
var colores=["#000000","#FF0000","#FF6A00","#FFD800","#B6FF00","#4CFF00","#00FFFF","#FFFFFF","#0094FF","#0026FF","#4800FF","#B200FF","#FF00DC","#FF006E"]

function dibujar_paleta(){
  let paleta=document.createElement("div");
  paleta.setAttribute('class','colores');
  let contador_colores=0;
  let fila=[];
    for(let j=0;j<8;j++){
         fila[j] =document.createElement('div');
         fila[j].setAttribute('id','fila'+(j+1));
         fila[j].setAttribute('class','fila_paleta');       
    for(let i=0;i<=1;i++){
        let muestra=document.createElement('div');   
        muestra.setAttribute('class','muestra');
        if(j>=7){
        muestra.style.background='#ffffff';
        muestra.className='muestra favorito';
        }else{
            muestra.setAttribute('id',colores[contador_colores]);
        muestra.style.background=colores[contador_colores];
        contador_colores++;
        }
        fila[j].appendChild(muestra);
    }
    paleta.appendChild(fila[j]);
    }
    caja_paleta.appendChild(paleta);
}
function dibujar_Panel_Usuario(){
  //botones
  let btns= document.createElement('div');
  btns.setAttribute('class','caja-botones');
    //tamaño de pincel
    let ctrl_size= document.createElement('input');
    ctrl_size.setAttribute('type','range');
    ctrl_size.setAttribute('min','0');
    ctrl_size.setAttribute('max','7');
    ctrl_size.setAttribute('step','1');
    ctrl_size.setAttribute('value','1');
    ctrl_size.setAttribute('id','tam-lapiz');
    //Guardado
    let btn_guardado = document.createElement('div');
    let icon_guardado = document.createElement('li');
    btn_guardado.setAttribute('class','btn h');
    icon_guardado.setAttribute('class','fas fa-save');
    btn_guardado.appendChild(icon_guardado);
    btns.appendChild(btn_guardado);
    btns.appendChild(ctrl_size);
    caja_paleta.appendChild(btns);
    //selector de pincel
}
var pizarra = document.querySelector('table');
function dibujar_pizarra(ancho,largo){
    //dibujar tantas tr y th como corresponda para lograr una pizarra
    //Creamos elementos que componen la tabla
    //asignamos, tantos fragmentos como sean los parametros
  for(let j=0;j<largo;j++){
    let fragmentos_alto = document.createElement('tr');
        fragmentos_alto.setAttribute('id','hei'+(j+1));
        for(let i = 0; i<ancho ;i++){
            let fragmentos_ancho = document.createElement('td');
            fragmentos_ancho.setAttribute('id','wid'+(i+1));
            fragmentos_ancho.setAttribute('class',"width pixel "+(i+1));
            fragmentos_ancho.setAttribute('style','background:'+pretBg);
            fragmentos_alto.appendChild(fragmentos_ancho);
            }
        pizarra.appendChild(fragmentos_alto);
        }
}

let datos = cargar_datos();  
dibujar_paleta();
dibujar_Panel_Usuario();
var tamaño_Pincel= document.querySelector('input#tam-lapiz');
tamaño_Pincel.addEventListener('change',()=>{
  tam_Pincel=tamaño_Pincel.valueAsNumber;
  
},false);

function guardado(){
  //recolectar muestras;
  var pizarra_guardada = document.querySelector('#_pizarra');
  let contenido= new Array();
  let _fila = new Array();
  let __fila = new Array();
  for(let fila =0 ; fila<pizarra_guardada.rows.length;fila++){
     //obtener una fila
     _fila[fila]=pizarra_guardada.rows[fila].children;  
     //guardar id de fila
     let __fila=[];
      //acceder a las celdas de la fila
      for(let celda =0;celda<pizarra_guardada.rows[fila].cells.length;celda++) { 
        //guardar en bandera el valor de la celda
        __fila.push(_fila[fila].item(celda).style.backgroundColor);
        //guardar en lista el valor de la celda;
      }
      contenido.push(__fila);
  }
  return contenido;
}
let jsonGuardado={};
const btnSave= document.querySelector('div.btn');
btnSave.addEventListener('click',()=>{
   jsonGuardado.data= guardado();
    axios.post('guardar_pizarra.php',jsonGuardado,{
      onDownloadProgress: progressEvent=>{
          document.body.style.cursor='wait';    
          }
      })
    .then((respuesta)=>{
      let data= respuesta.data;
      document.body.style.cursor='default';        
      }
    ).catch((error)=>{
      console.log("error: "+error);
    }); 
},false);


