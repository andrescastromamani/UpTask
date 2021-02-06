<?php 

    $accion = $_POST['accion'];
    $password = $_POST['password'];
    $usuario = $_POST['usuario'];

    if($accion == 'crear'){
        //crear los admins

        //hashear el password
        $opciones = array(
            'cost' => 12
        );
        $hash_password = password_hash($password, PASSWORD_BCRYPT,$opciones);
        //importar la conexion a l BD
        include '../funciones/conexion.php';
        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
            $stmt->bind_param('ss',$usuario, $hash_password);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_insertado' => $stmt->insert_id,
                    'tipo'=>$accion
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        } catch (exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }

    if($accion == 'login'){
        include '../funciones/conexion.php';

        try {
            $stmt = $conn->prepare("SELECT usuario, id, password FROM usuarios WHERE usuario = ?");
            $stmt->bind_param('s',$usuario);
            $stmt->execute();
            //Loguear usuario
            $stmt->bind_result($nombre_usuario,$id_usuario,$pass_usuario);
            $stmt->fetch();
            if($nombre_usuario){
                //Verificar el password
                if(password_verify($password, $pass_usuario)){
                    $respuesta = array(
                        'respuesta'=>'correcto',
                        'nombre'=>$nombre_usuario
                    );
                }else{
                    $respuesta = array(
                        'respuesta'=>'password incorrecto'
                    );
                }
            }else{
                $respuesta = array(
                    'error' => 'usuario no existe'
                );
            }
            $stmt->close();
            $conn->close();
        }catch (exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }