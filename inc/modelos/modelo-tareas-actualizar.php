<?php
    $accion = $_POST['accion'];
    $estado = $_POST['estado'];

    if($accion == 'actualizar'){
        
        echo json_encode($_POST);
    }