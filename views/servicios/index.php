<script type="text/javascript">
    function scroll(){
        location.href = "#servicios-titulo";
    }

</script>

<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2 id="servicios-titulo">Servicios</h2>

<?php

if(isset($_SESSION['operacion'])){
    switch($_SESSION['operacion']){
        case 'actualizar': $alertas['exito'][] = 'Servicio actualizadoo';break;
        case 'eliminar': $alertas['exito'][] = 'Servicio eliminado';break;
        case 'crear': $alertas['exito'][] = 'Servicio creado';break;
    }
    echo '<script type="text/javascript"> scroll(); </script>';
    array_pop($_SESSION);
}

include_once __DIR__ . '/../templates/alertas.php' ?>

<div class="barra-servicios-admin">
        <a href="/servicios/crear" class="boton">➕</br>Agregar</a>
</div>

<ul class="servicios">
    <?php foreach ($servicios as $servicio): ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>
            <?php if($servicio->oferta != 0){; ?>
                <p>Descuento: <span><?php echo $servicio->oferta . '% -> $' . round($servicio->precio * ((100 - $servicio->oferta) / 100), 0, PHP_ROUND_HALF_DOWN); ?></span></p>
            <?php }; ?>
            <p>Demora: <span><?php echo substr($servicio->demora, 1, 4); ?> horas</span></p>
            <div class="acciones">
                <div class="accion-proyecto">
                    <div class="texto-alerta">Fotos</div>
                    <a class="boton-foto" href="/servicios/fotos?id=<?php echo $servicio->id; ?>">📷</a>
                </div>
                
                <div class="accion-proyecto">
                    <div class="texto-alerta">Editar</div>
                    <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">📝</a>
                </div>
                <div class="accion-proyecto">
                    <div class="texto-alerta">Eliminar</div>
                    <form action="/servicios/eliminar" method="post">
                        <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                        <input type="submit" class="boton-eliminar" value="🗑️">
                    </form>
                </div>

            </div>
        </li>
    <?php endforeach; ?>
</ul>

