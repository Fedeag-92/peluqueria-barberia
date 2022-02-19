<h1 class="nombre-pagina">Panel de Administracion</h1>

<a href="/admin" class="boton">Volver</a>

<h2 id="tituloEditarFecha">Editar Fecha/Hora</h2>

<?php @include_once __DIR__ . '/../templates/alertas.php'?>

<form method="post" class="formulario">

    <div class="campo">
        <label for="nombre">ID</label>
        <input type="text" id="nombre" value="<?php echo $cita->id; ?>" disabled>
    </div>
    <div class="campo">
        <label for="cliente">Cliente</label>
        <input type="text" id="cliente" value="<?php echo $cliente; ?>" disabled>
    </div>
    <div class="campo">
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo $cita->fecha; ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
    </div>
    <div class="campo">
        <label for="hora">Hora: </label>
        <select id="hora">
            <option value="" disabled >--:--</option>
                <?php
                $i = 10;
                $max = 20;
                $hora = substr($cita->hora, 0, 5);
                while($i < $max){
                    $time = $i . ':00';
                    $id1 = 't' . $i . '00';
                    $time30 = $i . ':30';
                    $id2 = 't' . $i . '30';
                ?>
                <option id="<?php echo $id1 ?>" value="<?php echo $time ?>" <?php echo $hora  == $time ? 'selected' : '' ?>><?php echo $time ?></option>
                <option id="<?php echo $id2 ?>" value="<?php echo $time30 ?>" <?php echo $hora == $time30 ? 'selected' : '' ?>><?php echo $time30 ?></option>
                <?php
                ++$i;
                }
                ?>
        </select>
    </div>
    <div class="campo">
            <label for="demora">Demora</label>
            <input type="time" id="demora" value="<?php echo $cita->demoraTotal; ?>" disabled>
        </div>

    <input type="submit" class="boton" value="Actualizar Fecha/Hora">
</form>

<script src='/build/js/admin.js'></script>