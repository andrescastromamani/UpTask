<?php
    include 'inc/funciones/sesiones.php';
    include 'inc/funciones/funciones.php';
    include 'inc/templates/header.php';
    include 'inc/templates/barra.php';
    //Obtner el id
    
?>
    <div class="contenedor">
        <?php include 'inc/templates/sidebar.php';?>
        <main class="contenido-principal">
            <?php 
            if (isset($_GET['id_proyecto'])) {
                $id_proyecto = $_GET['id_proyecto'];
                $proyecto = obtenerNombreProyecto($id_proyecto);
                if ($proyecto){ ?>
                <h1>Proyecto Actual: 
                    <?php foreach($proyecto as $nombre):?>
                        <span><?php echo $nombre['nombre']; ?></span>
                    <?php endforeach; ?>
                </h1>

                <form action="#" class="agregar-tarea">
                    <div class="campo">
                        <label for="tarea">Tarea:</label>
                        <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
                    </div>
                    <div class="campo enviar">
                        <input type="hidden" value="<?php echo $id_proyecto;?>" id="id_proyecto">
                        <input type="submit" class="boton nueva-tarea" value="Agregar">
                    </div>
                </form>
                    
                <?php 
                }
            }else{
                    echo "<p>Selecciona un proyecto</p>";
            }?>
            <h2>Listado de tareas:</h2>

            <div class="listado-pendientes">
                <ul>
                    <?php 
                    if (isset($_GET['id_proyecto'])) {
                        $id_proyecto = $_GET['id_proyecto'];
                        $tareas = obtenerTareasProyectos($id_proyecto);
                        if ($tareas->num_rows > 0) {
                            //si hay tareas
                            foreach($tareas as $tarea){?>
                                <li id="tarea:<?php echo $tarea['id'] ?>" class="tarea">
                                <p><?php echo $tarea['nombre']; ?></p>
                                    <div class="acciones">
                                        <i class="far fa-check-circle <?php echo ($tarea['estado'] ==='1' ? 'completo':''); ?>" ></i>
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </li>  
                            <?php }
                        }else{
                            echo "<p class='lista-vacia'>No Existen Tareas asignadas</p>";
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="avances">
                <h2>Avance del Proyecto</h2>
                <div class="barra-avance" id="barra-avance">
                    <div class="porcentaje" id="porcentje"></div>
                </div>
            </div>
        </main>
    </div><!--.contenedor-->
<?php 
    include 'inc/templates/footer.php';
?>