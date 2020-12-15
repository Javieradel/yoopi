'use strict';
const pantalla = document.querySelector('.alertas');
let flag = false;
var Usuario = document.querySelector('#usuario');

const coleccion = '!¡\'#$%&/()=\\¿?\"[]{};,<>';

const pass = document.querySelector('#pass');

const sms_user = ["Usuario Invalido", "Usuario no existe"];

const entrar = document.querySelector('#entrar');

function Validar_Pass(input = document.querySelector('#pass')) {
    if (input.value == '') {
        if (!document.querySelectorAll('.pass').length) {
            mostrar_mensaje('Contraseña Invalida', 'pass');
            flag = true;
            return true;
        }
    } else {
        eliminar_mensaje("pass");
        flag = false
        return false
    }
}

function Validar_Usuario(input = document.querySelector("#usuario").value) {
    let error = false;
    //nombre Diferente a false
    if (input === "") {
        if (!document.querySelectorAll('section.alertas div p.usuario').length) {

            mostrar_mensaje(sms_user[0], "usuario");
        }

        error = true;
    }
    //nombre con caracteres Invalidos
    for (let j = 0; j < coleccion.length; j++) {
        if (input.includes(coleccion[j])) {
            if (!document.querySelectorAll('section.alertas div p.usuario').length) {

                mostrar_mensaje(sms_user[0], "usuario");
            }

            error = true;
            break;
        }

    }
    //usuario no mayor a 15 caracteres
    if (input.length > 15) {
        if (!document.querySelectorAll('section.alertas div p.usuario').length) {

            mostrar_mensaje(sms_user[0], "usuario");
        }

        error = true;
    }
    flag = error;
    return error;
}

function eliminar_mensaje(tipo) {
    const saltos = document.querySelectorAll("section.alertas br");
    const mensajes = document.querySelectorAll("p." + tipo);
    for (var i = 0; i <= mensajes.length - 1; i++) {
        mensajes[i].remove();
        saltos[i].remove();


    }
}

function mostrar_mensaje(mensaje, tipo) {

    let box = document.createElement("div");
    let ico = document.createElement('img');
    ico.src = "icons/error_ico.png";
    ico.setAttribute("style", "display:inline;");
    let salto = document.createElement("br");
    let li = document.createElement("p");

    li.classList.add(tipo);
    box.appendChild(ico);
    li.append(ico);
    li.append('\u00A0\u00A0' + mensaje);
    box.append(li);
    pantalla.appendChild(box);
    pantalla.append(salto);
}

Usuario.addEventListener('blur', function() {
    Usuario = document.querySelector('#usuario');
    console.log(Usuario.value);
    if (!Validar_Usuario(Usuario.value)) {
        eliminar_mensaje("usuario");
    }


}, false);

pass.addEventListener('blur', () => {
    Validar_Pass();
}, false);
//Habilitar entrar

entrar.addEventListener('click', () => {
    Validar_Usuario(document.querySelector("#usuario").value);
    Validar_Pass(document.querySelector('#pass'));
    if (!flag) {
        axios.post('ingreso.php', {

            _nombre: Usuario.value,
            _password: pass.value

        }).then((respuesta) => {
            console.log(respuesta.data);
            let data = respuesta.data;

            if (respuesta.data.url == 'personal_page.php') {
                document.location.href = data.url;
            }

            if (!(respuesta.data.user == undefined)) {
                if (!document.querySelectorAll('p.user').length) {
                    mostrar_mensaje(data.user, 'user');
                }

            }

            if (!(respuesta.data.pass == undefined)) {

                if (!document.querySelectorAll('p.pass').length) {
                    mostrar_mensaje(data.pass, 'pass');
                }

            }


        }).catch((error) => {
            console.log("error: " + error);
        });
    } else {
        alert('error campos invalidos');
    }

}, false)