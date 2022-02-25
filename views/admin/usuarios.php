<script type="text/javascript">
    function scroll(){
        location.href = "#usuarios-titulo";
    }

</script>

<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php include_once __DIR__ . '/../templates/barra.php' ?>

<h2 id="usuarios-titulo">Listado de Usuarios</h2>

<?php 

if(isset($_SESSION['operacion'])){
    switch($_SESSION['operacion']){
        case 'actualizar': $alertas['exito'][] = 'Usuario actualizado';break;
        case 'eliminar': $alertas['exito'][] = 'Usuario eliminado';break;
    }
    echo '<script type="text/javascript"> scroll(); </script>';
    array_pop($_SESSION);
}

include_once __DIR__ . '/../templates/alertas.php' ?>

<?php if(count($usuarios) === 0) {echo '<h3>No hay usuarios</h3>';} else{?>

<table class="usuarios">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Confirmado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <th><?php echo $usuario->nombre; ?></th>
                    <th><?php echo $usuario->apellido; ?></th>
                    <th><?php echo $usuario->telefono; ?></th>
                    <th><?php echo $usuario->confirmado == 0 ? 'NO' : 'SI'; ?></th>
                    <th>
                        <form method="POST" class="w-100" action="usuarios/eliminar">
                            <input type="hidden" name="id" value="<?php echo $usuario->id;?>">
                            <input type="submit" value="🗑️" class="boton-eliminar">
                        </form>
                        <a href="usuarios/actualizar?id=<?php echo $usuario->id; ?>" class="boton">📝</a>
                    </th>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php } ?>