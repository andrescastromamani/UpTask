addEventListeners();
listaProyectos = document.querySelector('#proyectos');
function addEventListeners(){
    //boton para crear un nuevo proyecto
    document.querySelector('.crear-proyecto a').addEventListener('click',nuevoProyecto);

    //boton de una nueva tarea
    document.querySelector('.nueva-tarea').addEventListener('click', agregarTarea);
}
function nuevoProyecto(e){
    e.preventDefault();
    console.log('presionaste ne crear nuevo proyecto');

    //Creamos el input
    var nuevoProyecto = document.createElement('li');
    nuevoProyecto.innerHTML = '<input type="text" id="nuevo-proyecto">';
    listaProyectos.appendChild(nuevoProyecto);
    //selecionar el id del nuevo proyecto
    var inputNuevoProyecto = document.querySelector('#nuevo-proyecto');
    //Al presionar enter se crea el nuevo proyecto
    inputNuevoProyecto.addEventListener('keypress',function(e){
        var tecla = e.wich || e.keyCode;
        if(tecla === 13){
            guardarProyectoBD(inputNuevoProyecto.value);
            listaProyectos.removeChild(nuevoProyecto);
        }
    })

}

function guardarProyectoBD(nombreProyecto){
    //inyectar el html
    /*var nuevoProyecto = document.createElement('li');
    nuevoProyecto.innerHTML = `
        <a href="#">
            ${nombreProyecto}
        </a>
    `;
    listaProyectos.appendChild(nuevoProyecto);*/
    //crear el llamado a AJAX
    var xhr = new XMLHttpRequest();
    //enviar dato por formdata
    var datos = new FormData();
    datos.append('proyecto',nombreProyecto);
    datos.append('accion','crear');
    //Abrir la conexion
    xhr.open('POST','inc/modelos/modelo-proyecto.php',true);
    //cargar
    xhr.onload = function(){
        if(this.status === 200){
            var respuesta = JSON.parse(xhr.responseText);
            var proyecto = respuesta.nombre,
                id = respuesta.id_insertado,
                tipo = respuesta.tipo,
                resultado = respuesta.respuesta;
            if(resultado === 'correcto'){
                if(tipo === 'crear'){
                    var nuevoProyecto = document.createElement('li');
                    nuevoProyecto.innerHTML = `
                        <a href="index.php?id_proyecto=${id}">
                            ${proyecto}
                        </a>
                    `;
                    //agregar a la lista
                    listaProyectos.appendChild(nuevoProyecto);
                    //enviar alerta success
                    Swal.fire({
                        icon: 'success',
                        title: 'Proyecto Creado',
                        text: 'Proyecto '+proyecto+' creado correctamente'
                    })
                    .then(resultado =>{
                        if(resultado.value){
                            window.location.href = 'index.php?id_proyecto='+id;                        
                        }
                    })
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Hubo un error'
                })
            }
        }
    }
    xhr.send(datos);
}

//Agregar nueva tarea
function agregarTarea(e){
    e.preventDefault();
    var nombreTarea = document.querySelector('.nombre-tarea').value;
    if(nombreTarea === ''){
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Debe Llenar el Campo'
        })
    }else{

    }
}