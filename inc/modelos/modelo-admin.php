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
        $respuesta = array(
            'pass' => $hash_password
        );
        echo json_encode($respuesta);
    }

    if($accion == 'login'){
        
    }