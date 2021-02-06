<script src="js/sweetalert2.all.min.js"></script>
<?php 
    $actual = obtenerPaginaActual();
    //var_dump($actual);
    if($actual == 'login' || $actual == 'crear-cuenta'){
        echo '<script src="js/formulario.js"></script>';
    }
?>
</body>
</html>