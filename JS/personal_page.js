/***********************************************
PALETA DE INICIO

-   CREAR NUEVA CREACION
    - INICIAR NUEVA CREACION(DATOS DE CREACION)
-   MODIFICAR CREACION EXISTENTE
    - RECUPERAR CREACION (NOMBRE, ATHOR)
-   EXPLORAR
    - EXTRAER TODAS LAS CREACIONES E INICIAR PAGINACION(FILTRO)
-   VER MEJORES
    - EXTRAER MAS VALORADAS (FILTRO)

************************************************/
let datos_sesion = function obtenerDatos() {



    return data;
}
let contenedor = document.querySelector('main.contenedor-menu');
const expresion = /\W/;
let datos = [];
let config = {
    onDownloadProgress: progressEvent => {

        document.body.style.cursor = 'wait';

    }

}

/******************************************
 Seleccion Nuevo Dibujo
 ******************************************/
/***********************************************
PALETA DE INICIO

-   CREAR NUEVA CREACION
    - INICIAR NUEVA CREACION(DATOS DE CREACION)
-   MODIFICAR CREACION EXISTENTE
    - RECUPERAR CREACION (NOMBRE, ATHOR)
-   EXPLORAR
    - EXTRAER TODAS LAS CREACIONES E INICIAR PAGINACION(FILTRO)
-   VER MEJORES
    - EXTRAER MAS VALORADAS (FILTRO)

************************************************/
//let body=document.querySelector('main');

let formulario = formularioCreacion('form', 'FormularioC');
let subir = formulario.lastChild;
let inputsFormulario = formulario.children;

function menu() {
    const numero_de_elementos = 4;

    let menu = document.createElement('div');
    menu.setAttribute('class', 'menu')

    for (let i = 1; i <= numero_de_elementos; i++) {
        let btn = document.createElement('div');
        btn.setAttribute('class', 'btn');
        switch (i) {
            case 1:
                {

                    btn.setAttribute('id', 'crear');
                }
                break;
            case 2:
                {
                    btn.setAttribute('id', 'editar');
                }
                break;

            case 3:
                {
                    btn.setAttribute('id', 'mejores');
                }
                break;
        }
        menu.appendChild(btn);
    }
    return menu;
}
let _menu = menu();
contenedor.appendChild(_menu);
/***************************************************
 * FIN MENU
 ***************************************************/
/*
    Componente de creación
*/
function crearInputs(id, tipo, placeholder) {
    let input = document.createElement('input');
    if (tipo == "number") {
        input.setAttribute('max', '1200');
        input.setAttribute('min', '40');
        input.setAttribute('step', '10');
        input.setAttribute('value', '50');
    }
    if (tipo == 'button') {
        input.setAttribute('value', String(placeholder));
    } else {
        input.setAttribute('placeholder', String(placeholder));
    }
    input.setAttribute('type', String(tipo));
    input.setAttribute('id', String(id));
    input.setAttribute('placeholder', String(placeholder));
    input.setAttribute('required', 'required');

    return input;
}

function mostrar_mensaje(mensaje, tipo) {

    let box = document.createElement("div");
    let ico = document.createElement('img');
    if (tipo == 'ok') {
        ico.src = "icons/ok_icon.png";
    } else {
        ico.src = "icons/error_ico.png";
    }

    ico.setAttribute("style", "display:inline;");
    let salto = document.createElement("br");
    let li = document.createElement("p");
    li.classList.add(tipo);
    box.appendChild(ico);
    li.append(ico);
    li.append('\u00A0\u00A0' + mensaje);
    box.append(salto);
    box.append(li);
    formulario.insertBefore(box, subir);

}

function formularioCreacion(clase, id) {
    let formulario = document.createElement('div');
    formulario.setAttribute('class', clase);
    formulario.setAttribute('id', id);
    formulario.appendChild(crearInputs('NombreC', 'text', 'Titulo'));

    formulario.appendChild(crearInputs('AlturaC', 'number', 'Alto'));

    formulario.appendChild(crearInputs('AnchoC', 'number', 'Ancho'));

    formulario.appendChild(crearInputs('DescripcionC', 'text', 'Descripcion'));

    formulario.appendChild(crearInputs('Subir', 'button', 'Empezar'));

    return formulario;
}
/**
 * ********************
 */
//PAGINACION DE EDICIÓN
function pagina() {
    let pagina = document.createElement('section');
    let right = document.createElement('button');
    let artic = document.createElement('div');
    let left = document.createElement('button');
    pagina.setAttribute('class', 'paginacion');
    right.setAttribute('id', 'right');

    artic.setAttribute('class', 'articulos');
    left.setAttribute('id', 'left');
    pagina.append(left, artic, right)

    return pagina;

}

function crearTargeta(titulo, thumb, descripcion, author) {
    let targeta = document.createElement('div');
    let contenedorPicture = document.createElement('div');
    let imagen = document.createElement('img');
    let title = document.createElement('h4');
    let descrip = document.createElement('p');
    let auth = document.createElement('p');

    targeta.setAttribute('class', 'target');
    contenedorPicture.setAttribute('class', 'picture');
    imagen.setAttribute('src', thumb)
    title.setAttribute('class', 'title');
    descrip.setAttribute('class', 'description');
    auth.setAttribute('class', 'author');

    title.append(String(titulo));
    descrip.append(String(descripcion));
    auth.append(String(author));
    contenedorPicture.appendChild(imagen);
    targeta.append(contenedorPicture, title, descrip, auth)

    return targeta;
}

function render(min, max, ob, list) {

    while (ob.childNodes.length != 0) {
        for (let i = 0; i < ob.childNodes.length; i++) {
            ob.childNodes[i].remove();
        }
        console.log('outfor');
    }

    for (let i = min; i < max; i++) {
        if (i == list.length) {
            break;
        }
        ob.append(list[i]);

    }

}
let ___menu = document.querySelectorAll('div.btn');
let crear = ___menu[0];
let editar = ___menu[1];
let explorar = ___menu[2];
let mejores = ___menu[3];
/**
 * ******************************
 */
/**
 * ACTIVACION DE MENU
 */
crear.addEventListener('click', (event) => {

    if (document.querySelector('main div.form')) {
        document.querySelector('main div.form').remove();
    } else {
        formulario.style.position = 'absolute';
        formulario.style.top = String(event.y) + 'px';
        formulario.style.left = String(event.x) + 'px';
        contenedor.appendChild(formulario);
    }
}, false);
subir.addEventListener('click', () => {
    console.log('vlivk');

    axios.post('asignar_espacio.php', {
            _titulo: inputsFormulario[0].value,
            _dimension: inputsFormulario[1].value + " x " + inputsFormulario[2].value,
            _description: inputsFormulario[3].value
        }, config)
        .then((respuesta) => {
            document.body.style.cursor = 'default';
            console.log(respuesta.data);
            if (respuesta.data.error == undefined && respuesta.data.estado == 'ok') {
                document.location.href = 'pizarra.php';
            } else {
                if (!document.querySelectorAll('div.form div p.error').length) {
                    mostrar_mensaje(respuesta.data.error, 'error');
                }

            }

        }).catch((err) => {

            console.log("error: " + err);

        });



}, false);

editar.addEventListener('click', () => {


    if (document.querySelector('main section.paginacion')) {
        document.querySelector('main section.paginacion').remove();

    } else {
        contenedor.parentElement.appendChild(pagina());
        var objet = document.querySelector('section.paginacion div.articulos');
        console.log(objet);
        let arra = Array();
        const numerosElementos = 6;
        const siguiente = document.querySelector('#right');
        const atras = document.querySelector('#left');
        atras.setAttribute('disabled', 'disabled');
        let paginas = 0;
        let paginaActual = 1;
        let paginaAnterior = 0;
        let ultimoArticulo = 5;
        axios.get('obtenerCreaciones.php', {
                // filtro de busqueda;
                key: "All"
            }, {
                onDownloadProgress: progressEvent => {
                    document.body.style.cursor = 'wait';
                    objet.innerHTML = "CARGANDO...";
                }
            })
            .then((respuesta) => {
                document.body.style.cursor = 'default';
                datos = respuesta.data;
                console.log(datos);
                for (let i = 0; i < datos.length; i++) {
                    arra.push(crearTargeta(datos[i].title, datos[i].thumb, datos[i].description, datos[i].author));
                    console.log(paginaActual + ' ' + paginas + ' ' + paginaAnterior + ' ' + ultimoArticulo);

                }
                if (arra.length % numerosElementos != 0) {
                    paginas = parseInt(arra.length / numerosElementos) + 1;
                    console.log(paginas);
                } else {
                    paginas = parseInt(arra.length / numerosElementos);
                    console.log(paginas);
                }
                render(paginaAnterior, numerosElementos, objet, arra);
            }).catch((err) => {
                console.log("error: " + err);
            });
        siguiente.addEventListener('click', () => {
            atras.removeAttribute('disabled');

            render(ultimoArticulo, ultimoArticulo + 6, objet, arra);
            ultimoArticulo += 6;
            paginaActual++;
            if (paginaActual >= paginas) {
                siguiente.setAttribute('disabled', 'disabled');
            }
            paginaAnterior++;
            // console.log(paginaActual +' '+ paginas+' '+paginaAnterior+' '+ultimoArticulo );

        }, false);
        atras.addEventListener('click', () => {
            siguiente.removeAttribute('disabled');
            paginaAnterior--;
            render((paginaAnterior * 6), ultimoArticulo - 5, objet, arra);
            ultimoArticulo -= 6;
            paginaActual--;
            if (paginaActual == 1) {
                atras.setAttribute('disabled', 'disabled');
            }
            // console.log(paginaActual +' '+ paginas+' '+paginaAnterior+' '+ultimoArticulo );


        }, false)



    }
}, false);