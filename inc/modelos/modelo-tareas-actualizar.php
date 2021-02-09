<?php
    $accion = $_POST['accion'];
    $estado = $_POST['estado'];
    $id_tarea = $_POST['id'];
    if($accion == 'actualizar'){
        
        //importar la conexion a l BD
        include '../funciones/conexion.php';
        try {
            $stmt = $conn->prepare("UPDATE tareas set estado = ? WHERE id = ?");
            $stmt->bind_param('ii',$estado,$id_tarea);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'correcto'
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