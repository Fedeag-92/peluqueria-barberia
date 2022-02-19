<h1 class="nombre-pagina">Panel de Administracion</h1>

<a href="/usuarios" class="boton">Volver</a>

<h2>Actualizar Usuario</h2>

<?php @include_once __DIR__ . '/../templates/alertas.php'?>

<form method="post" class="formulario">

    <?php @include_once __DIR__ . '/formulario.php'?>

    <input type="submit" class="boton" value="Actualizar Usuario">
</form>