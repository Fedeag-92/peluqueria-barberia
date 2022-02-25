<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<?php
if($_SERVER['SERVER_NAME'] == 'localhost'){
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === 'http://localhost:3000/cita'){
        $alertas['exito'][] = 'Sesion Cerrada';
    }
}else{
    if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === 'https://peluqueria-barberia-nqn.herokuapp.com/cita'){
        $alertas['exito'][] = 'Sesion Cerrada';
    }
}

include_once __DIR__ . '/../templates/alertas.php' ?>

<form action="" class="formulario" method="post">
    <div class="campo">
        <label for="email">E-mail: </label>
        <input type="email" id="email" placeholder="Tu Email" name="email">
    </div>
    <div class="campo">
        <label for="password">Password: </label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>
    <input type="submit" class="boton" value="Iniciar Sesion">
</form>

<div class="acciones">
    <a href="crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
    <a href="olvide">¿Olvidaste tu password?</a>
</div>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost:3000/");
    }
</script>