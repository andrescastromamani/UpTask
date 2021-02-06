addEventListeners();
function addEventListeners(){
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e){
    e.preventDefault();
    //console.log('aqui vamos');
    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value;

    if(usuario === '' || password === ''){
        Swal.fire({
            icon: 'error',
            title: 'Hubo un Error!',
            text: 'Todos los campos son Obligatorios'
          })
    }else{
        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: 'correctamente'
          })
    }
}