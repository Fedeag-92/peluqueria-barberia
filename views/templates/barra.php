<div class="barra">
    <div class="usuario-barra">
        <p><i class='fas fa-user-circle'></i><i class='fas fa-angle-down'></i>&nbsp;</p>
        <p id="nombre-usuario-barra"><?php echo $nombre ?? ''; ?></p>
    </div>


    <a class="boton" href="/logout">Cerrar Sesion</a>
</div>
<div class="acciones-usuario">
    <p class="mis-citas">Mis Citas</p>
    <p class="cambiar-nombre">Cambiar nombre</p>
    <p class="cambiar-password">Cambiar password</p>
    <p class="cambiar-telefono">Cambiar telefono</p>
</div>
<div id="overlay">

</div>

<?php if(isset($_SESSION['admin'])): ?>
    <div class="barra-admin">
        <a href="/admin" class="boton <?php echo ($tabCitas) ? 'activo' : ''; ?>">Citas</a>
        <a href="/usuarios" class="boton <?php echo ($tabUsuarios) ? 'activo' : ''; ?>">Usuarios</a>
        <a href="/servicios" class="boton <?php echo ($tabServicios) ? 'activo' : ''; ?>">Servicios</a>
        <a href="/sucursal" class="boton <?php echo ($tabSucursal) ? 'activo' : ''; ?>">Sucursal</a>
    </div>
<?php endif; ?>

<?php $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
    ";
?>