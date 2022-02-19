<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2>Datos de la Sucursal</h2>


<div class="contenedor-datos-sucursal">
    <p>Nombre: </p>
    <p class="sucursal-campo"><?php echo $sucursal->nombre; ?></p>
    <p>Ciudad: </p>
    <p class="sucursal-campo"><?php echo $sucursal->ciudad; ?></p>
    <p>Direccion: </p>
    <p class="sucursal-campo"><?php echo $sucursal->direccion; ?></p>
    <p>Dia inicial: </p>
    <p class="sucursal-campo"><?php echo $sucursal->diaInicio; ?></p>
    <p>Dia final: </p>
    <p class="sucursal-campo"><?php echo $sucursal->diaFin; ?></p>
    <p>Hora de apertura: </p>
    <p class="sucursal-campo"><?php echo $sucursal->horaInicio; ?></p>
    <p>Hora de cierre: </p>
    <p class="sucursal-campo"><?php echo $sucursal->horaCierre; ?></p>

    <a class="boton" href="sucursal/actualizar">🔄</a>
</div>