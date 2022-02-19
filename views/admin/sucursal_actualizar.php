<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2>Actualizar Datos de la Sucursal</h2>


<form method="post" class="formulario">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" placeholder="Nombre Sucursal" name="nombre" value="<?php echo $sucursal->nombre; ?>">
    </div>
    <div class="campo">
        <label for="ciudad">Ciudad</label>
        <input type="text" id="ciudad" placeholder="Ciudad Sucursal" name="ciudad" value="<?php echo $sucursal->ciudad; ?>">
    </div>
    <div class="campo">
        <label for="direccion">Direccion</label>
        <input type="text" id="direccion" placeholder="Direccion Sucursal" name="direccion" value="<?php echo $sucursal->direccion; ?>">
    </div>
    <div class="campo">
        <label for="diaInicio">Dia Inicio</label>
        <input type="text" id="diaInicio" placeholder="Dia Inicio Sucursal" name="diaInicio" value="<?php echo $sucursal->diaInicio; ?>">
    </div>
    <div class="campo">
        <label for="diaFin">Dia Fin</label>
        <input type="text" id="diaFin" placeholder="Dia Fin Sucursal" name="diaFin" value="<?php echo $sucursal->diaFin; ?>">
    </div>
    <div class="campo">
        <label for="horaInicio">Hora Apertura</label>
        <input type="time" id="horaInicio" placeholder="Hora Inicio Sucursal" name="horaInicio" value="<?php echo $sucursal->horaInicio; ?>">
    </div>
    <div class="campo">
        <label for="horaCierre">Hora Cierre</label>
        <input type="time" id="horaCierre" placeholder="Hora Cierre Sucursal" name="horaCierre" value="<?php echo $sucursal->horaCierre; ?>">
    </div>
    <div class="campo">
        <label for="cerrado">Cerrado</label>
        <input type="text" id="cerrado" placeholder="En caso de cerrar por momento" name="cerrado" value="<?php echo $sucursal->cerrado; ?>">
    </div>

    <input type="submit" class="boton" value="Actualizar Sucursal">
</form>