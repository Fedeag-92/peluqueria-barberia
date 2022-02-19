<h1 class="nombre-pagina">Recuperar Password</h1>

<p class="descripcion-pagina">Ingresa una nueva contraseña a continuacion</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if($error) return; ?>
<form class="formulario" method="post">
    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Nuevo Password">
    </div>
    <input type="submit" value="Guardar Nuevo Password" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesion</a>
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
</div>