<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina" id="descripcion-pagina">Elije tus servicios y coloca tus datos.</p>

<div id="app">
    <nav class="tabs">
        <button type="button" class="actual" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion y Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div class="seccion mostrar" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios a continuacion</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>
    <div class="seccion" id="paso-2">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" placeholder="Tu Nombre" value="<?php echo $nombre ?>" disabled>
            </div>
            <div class="campo">
                <label for="direccion">Lugar: </label>
                <input type="text" id="direccion" placeholder="Direccion Sucursal" value="<?php echo $direccion ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha: </label>
                <input type="date" id="fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
            </div>
            <div class="campo">
                <label for="hora">Hora: </label>
                <select id="hora" disabled>
                    <option value="" disabled selected >--:--</option>
                        <?php
                        $i = 10;
                        $max = 20;
                        while($i < $max){
                            $time = $i . ':00';
                            $id1 = 't' . $i . '00';
                            $time30 = $i . ':30';
                            $id2 = 't' . $i . '30';
                        ?>
                        <option id="<?php echo $id1 ?>" value="<?php echo $time ?>"><?php echo $time ?></option>
                        <option id="<?php echo $id2 ?>" value="<?php echo $time30 ?>"><?php echo $time30 ?></option>
                        <?php
                        ++$i;
                        }
                        ?>
                </select>
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div class="seccion" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
        <div class="contenido-resumen"></div>
    </div>

    <div class="paginacion">
        <button class="boton ocultar" id="anterior">&laquo; Anterior</button>
        <button class="boton" id="siguiente">Siguiente &raquo;</button>
    </div>
</div>



<?php $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
    <script src='build/js/moment.min.js'></script>";
?>
