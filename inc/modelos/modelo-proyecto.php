<?php
    $accion = $_POST['accion'];
    $proyecto = $_POST['proyecto'];

    if($accion == 'crear'){
        //importar la conexion a l BD
        include '../funciones/conexion.php';
        try {
            $stmt = $conn->prepare("INSERT INTO proyectos (nombre) VALUES (?)");
            $stmt->bind_param('s',$proyecto);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_insertado' => $stmt->insert_id,
                    'tipo'=>$accion,
                    'nombre'=> $proyecto
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