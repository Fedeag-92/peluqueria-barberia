<h1 class="nombre-pagina">Panel de Administracion</h1>

<a href="/servicios" class="boton">Volver</a>

<h2>Crear Servicio</h2>

<?php @include_once __DIR__ . '/../templates/alertas.php'?>

<form action="/servicios/crear" method="post" class="formulario" enctype="multipart/form-data">

    <?php @include_once __DIR__ . '/formulario.php'?>

    <input type="submit" class="boton" value="Crear Servicio">
</form>