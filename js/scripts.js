addEventListeners();
listaProyectos = document.querySelector('#proyectos');
function addEventListeners(){
    //boton para crear un nuevo proyecto
    document.querySelector('.crear-proyecto a').addEventListener('click',nuevoProyecto);
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
    console.log(nombreProyecto);
}