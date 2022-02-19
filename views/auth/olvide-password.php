<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuacion</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form action="olvide" class="formulario" method="post">
    <div class="campo">
        <label for="email">E-mail: </label>
        <input type="email" id="email" name="email" placeholder="Tu E-mail">
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">
</form>
<div class="acciones">
    <a href="./">¿Ya tienes una cuenta? Inicia sesion</a>
    <a href="crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
</div>