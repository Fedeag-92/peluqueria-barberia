<script type="text/javascript">
    function scroll(){
        location.href = "#servicios-titulo";
    }

</script>

<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2 id="citas-admin">Buscar Citas</h2>

<?php 

if(isset($_SESSION['operacion'])){
    switch($_SESSION['operacion']){
        case 'actualizar': $alertas['exito'][] = 'Cita actualizada';break;
        case 'eliminar': $alertas['exito'][] = 'Cita eliminada';break;
    }
    echo '<script type="text/javascript"> scroll(); </script>';
    array_pop($_SESSION);
}

include_once __DIR__ . '/../templates/alertas.php' ?>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php if(count($citas) === 0) echo '<h3>No hay citas en esta fecha</h3>'; ?>

<div class="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        $esUltimo = false;
        $ultimo = end($citas);
        foreach($citas as $key => $cita):
            if($idCita !== $cita->id): ?>
            <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p>E-mail: <span><?php echo $cita->email; ?></span></p>
                <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
                <p>Hora: <span><?php echo $cita->hora; ?> - <?php echo $cita->finaliza; ?></span></p>
                <h3>Servicios</h3>
                <p>Total: <span>$<?php echo $cita->total; ?></span></p>

                <?php
                $idCita = $cita->id;
                 endif;
                 //Si es el ultimo servicio de una cita se cambia la variable esUltimo a true, para mostrar el cartel de eliminar
                    if($cita->id != ($citas[$key + 1]->id ?? 0) || $cita == $ultimo){ $esUltimo = true;}
                 ?>

                <p class="servicio"><?php echo $cita->servicio; ?>: <span>$<?php echo ($cita->oferta == 0) ? $cita->precio : ($cita->precio * ((100 - $cita->oferta) / 100)); ?><?php echo ($cita->oferta == 0) ? '' : ' (' . $cita->oferta . '%OFF)';?></span></p>
                <?php if($esUltimo): ?>
                    <div class="acciones-cita">
                        <form action="/api/eliminar" method="post">
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <input type="submit" class="boton-eliminar" value="Eliminar">
                        </form>
                        <a class="boton" href="/cita/actualizar?id=<?php echo $cita->id; ?>&cliente=<?php echo urlencode($cita->cliente); ?>">Editar</a>
                    </div>
                   
                <?php 
                    $esUltimo = false;
                    endif; ?>
            <?php endforeach; ?>
    </ul>
</div>

<?php
    $script .= "<script src='build/js/buscador.js'></script>";
    
?>