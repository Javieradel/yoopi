'use strict';
//Validacion de Datos
//Habilitar campos segun se vayan rellenando
//validar datos para habilitar siguiente input;
const sms_user=["Usuario ya existe",
" Usuario solo puede contener maximo 15 caracteres",
"Usuario Invalido",
"Usuario no puede estar Vacio"];
const sms_pass=["La Contraseña debe contener minimo 8 Caracteres",
            "Debe contener Caracteres Especiales",
            "Debe contener Numeros",
            "Debe contener Mayusculas",
            "Debe contener Minusculas"];
const coleccion=['abcdefghijklmñopqrstuvwxyz',"!¡\'#$%&/()=\\¿?\"[]{};,<>","0123456789","/*.!#$"];
const sms_email=["Email Invalido", "Email ya en uso"];
const expresion = /\W/;
const mayus= /[A-Z]/;
const minus= /[a-z]/;
const num= /[0-9]/;
	
const pantalla = document.querySelector('.alertas');
const usuario=document.querySelector('input#usuario');
const pass= document.querySelector("#pass");
const pass2 =document.querySelector("#pass2");
const email = document.querySelector("#email");
const email2 = document.querySelector("#email2");
 const consultar = document.querySelector('#entrar');
    
        //Realizar mediante JavaScript, algoritmos que  
        //validen los datos ingresados al formulario
        
        function Validar_Usuario(input = document.querySelector("#usuario").value){
            let error = false;
            //nombre Diferente a false
            if(input==""){
                if(!document.querySelectorAll("section.alertas div .usuario").length){
                mostrar_mensaje(sms_user[3],"usuario");}
                error=true;
            }
            //nombre con caracteres Invalidos
            for(let j=0 ; j<coleccion[1].length ; j++){
                if(input.includes(coleccion[1][j])){
                    if(!document.querySelectorAll("section.alertas div .usuario").length){
                    mostrar_mensaje(sms_user[2],"usuario");}
                    error=true;
                    break;
                }  
            
            }
        //usuario no mayor a 15 caracteres
        if(input.length>15){
            if(!document.querySelectorAll("section.alertas div .usuario").length){
            mostrar_mensaje(sms_user[1],"usuario");}
            error=true;
        }
    return error;    
        }
        function Validar_Pass(input=document.querySelector("#pass").value){
        
            if(input.length<8){
            	if(!document.querySelectorAll("section.alertas div .pass-small").length){
                mostrar_mensaje(sms_pass[0],"pass-small");
                
            }
            return "small";
        }
             
                if(!expresion.test(input)){
                	if(!document.querySelectorAll("section.alertas div .pass-especial").length){
                    mostrar_mensaje(sms_pass[1],"pass-especial");
                     
                    }
                    return "especial";
                

                    
                }
            
                
                    if(!num.test(input)){
                        if(!document.querySelectorAll("section.alertas div .pass-num").length){
                             mostrar_mensaje(sms_pass[2],"pass-num");
                    }
                    return "num";
                }
            
                    if (!mayus.test(input)){
                          if(!(document.querySelectorAll("section.alertas div .pass-aA").length)){
                                mostrar_mensaje(sms_pass[3],"pass-aA");                 
                                }
                                return "aA";
                            } 
                    if (!minus.test(input)){
                        if(!(document.querySelectorAll("section.alertas div .pass-aA").length)){
                                mostrar_mensaje(sms_pass[4],"pass-aA"); 
                                }
                                return "aA";
                            }
            return false;
            }
        function confirme_pass(){
                
            if (pass.value != pass2.value ){
                if(!(document.querySelectorAll("section.alertas div .pass2").length)){
                mostrar_mensaje("Las Contraseñas no Cohinciden","pass2");
                return true;}
                }   
                return false;
        }
        function Validar_Email(input=document.querySelector("#email").value){
            let error=false;
            if((!input.includes("@") )| (!input.includes("."))){
                mostrar_mensaje(sms_email[0],"email");
                error=true;
            }
            return error;
        }
        function confirme_email(email=document.querySelector('input[name="correo"]').value,email2=document.querySelector('input[name="correoc"]').value){
            
            if (email != email2){
                mostrar_mensaje("Correos no Cohinciden","email2");
                return true;
            }
            return false;
        }
        function eliminar_mensaje(tipo){
            if(tipo==='ALL'){
                let all= document.querySelectorAll('section.alertas div');
                for(var i=0; i<=all.length-1;i++){
                    all[i].remove();
                    }
            }
            const saltos=document.querySelectorAll("section.alertas div br");
            const mensajes=document.querySelectorAll("p."+tipo);
                for(var i=0; i<=mensajes.length-1;i++){
                        mensajes[i].remove();
                        saltos[i].remove();
                        
                        
                        }
                       
                        
                    }
        function mostrar_mensaje(mensaje,tipo){
        
            let box = document.createElement("div");
            let ico = document.createElement('img');
            if(tipo=='ok'){
                ico.src= "icons/ok_icon.png";
            }else{
                ico.src= "icons/error_ico.png"; 
            }
            
            ico.setAttribute("style","display:inline;");
            let salto = document.createElement("br");  
            let li = document.createElement("p");
            li.classList.add(tipo);
            box.appendChild(ico);
            li.append(ico);
            li.append('\u00A0\u00A0' +mensaje);
            box.append(salto);
            box.append(li);
            pantalla.appendChild(box);
            
    }
usuario.addEventListener('blur',()=>{
    console.log(usuario.value);
    
    if(!Validar_Usuario()){
    eliminar_mensaje("usuario");
    }
                                                
},false);
pass.addEventListener("blur",()=>{
     
     if(!(Validar_Pass()=="aA")){
        eliminar_mensaje("pass-aA");
    }
     
     if(!(Validar_Pass()=="small")){

        eliminar_mensaje("pass-small");
    }
    
    if(!(Validar_Pass()=="especial")){
        eliminar_mensaje("pass-especial");
    }
    
     if(!(Validar_Pass()=="num")){
        eliminar_mensaje("pass-num");
    }   
},false)
pass2.addEventListener("blur",()=>{
    if(!confirme_pass()){
        eliminar_mensaje("pass2");
    }
},false)       
email.addEventListener("blur",()=>{
    if(!Validar_Email()){
        eliminar_mensaje("email");

    }
    if(!confirme_email()){
        eliminar_mensaje("email");

    }
    
    
},false);
email2.addEventListener("blur",()=>{
    if(!confirme_email()){
        eliminar_mensaje("email2");

    }
},false)

//--------------------------------------------------------------------

//manejo de datos
    // enviar mediante AJAX el usuario obtener respuesta si existe o si es correcto
    //chequear correo no este en uso
    //si correo y Usuario no estan en DB obtener Registro Exitoso
    // enviar Password, correo y encriptar
    //Borrar formulario
    //Cargar inicio
    

    consultar.addEventListener('click',()=>{
    	console.log('consultando');
               
    axios.post('registrar_Usuario.php',{
       
            _nombre:usuario.value,
            _email:email2.value,
            _password:pass.value
        
    })
    .then((respuesta)=>{
        console.log(respuesta.data);
        let data= respuesta.data;
       
        if(data.sms_user!=''){
            mostrar_mensaje(sms_user[data.sms_user],'usuario');
        }
        if(data.sms_email!=''){
            mostrar_mensaje(sms_email[data.sms_email],'usuario');
        }
        if(data.registro!='OK'){
            mostrar_mensaje("Error en el registro.",'err-registro');
        }else{
           eliminar_mensaje('ALL')
           mostrar_mensaje("Registro Exitoso!!!",'ok');
           consultar.setAttribute('disabled','disabled');
        }

        }
).catch((error)=>{
        console.log("error: "+error);
    });   
    },false)

