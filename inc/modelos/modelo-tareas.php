<?php
    $accion = $_POST['accion'];
    $id_proyecto = (int)$_POST['id_proyecto'];
    $tarea = $_POST['tarea'];

    if($accion == 'crear'){
        //importar la conexion a l BD
        include '../funciones/conexion.php';
        try {
            $stmt = $conn->prepare("INSERT INTO tareas (nombre, id_proyecto) VALUES (?, ?)");
            $stmt->bind_param('ss',$tarea,$id_proyecto);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_insertado' => $stmt->insert_id,
                    'tipo'=>$accion,
                    'tarea'=> $tarea
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