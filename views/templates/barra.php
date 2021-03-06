<div class="barra">
    <div class="usuario-barra">
        <p><ion-icon name="person-circle-outline"></ion-icon><ion-icon name="chevron-down-outline"></ion-icon>&nbsp;</p>
        <p id="nombre-usuario-barra"><?php echo $nombre ?? ''; ?></p>
    </div>

    <a class="boton" href="/logout"><ion-icon name="log-out-outline"></ion-icon>Cerrar Sesion</a>
</div>
<div class="acciones-usuario">
    <p class="mis-citas"><ion-icon name="list-outline"></ion-icon>Mis Citas</p>
    <p class="cambiar-nombre"><ion-icon name="create-outline"></ion-icon>Cambiar nombre</p>
    <p class="cambiar-password"><ion-icon name="create-outline"></ion-icon>Cambiar password</p>
    <p class="cambiar-telefono"><ion-icon name="create-outline"></ion-icon>Cambiar telefono</p>
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