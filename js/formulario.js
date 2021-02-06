addEventListeners();
function addEventListeners(){
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e){
    e.preventDefault();
    //console.log('aqui vamos');
    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value,
        tipo = document.querySelector('#tipo').value;

    if(usuario === '' || password === ''){
        //Cuando la validacion fallo
        Swal.fire({
            icon: 'error',
            title: 'Hubo un Error!',
            text: 'Todos los campos son Obligatorios'
          })
    }else{
        //Si los datos son correctos

        //datos que se envian al servidor
        var datos = new FormData();
        datos.append('usuario',usuario);
        datos.append('password',password);
        datos.append('accion',tipo);
        
        //crear el llamado a Ajax
        var xhr = new XMLHttpRequest();
        //abrir la conexion
        xhr.open('POST','inc/modelos/modelo-admin.php',true);
        //retornar los datos
        xhr.onload = function(){
            if(this.status === 200){
                var respuesta = JSON.parse(xhr.responseText);
                //si respuesta es correcta
                if(respuesta.respuesta === 'correcto'){
                    //si es nuevo usuario
                    if(respuesta.tipo === 'crear'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto',
                            text: 'Se Creo Correctamente'
                          })
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Hubo un Error!',
                        text: 'error'
                      })
                }
            }
        }
        //enviar los datos
        xhr.send(datos);

    }
}