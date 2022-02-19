<script type="text/javascript">
    function scroll(){
        location.href = "#fotos-titulo";
    }

</script>

<h1 class="nombre-pagina">Panel de Administracion</h1>

<a href="/servicios" class="boton">Volver</a>

<h2 id="fotos-titulo">Fotos: <?php echo $servicioNombre ?></h2>

<?php
if(isset($_SESSION['operacion'])){
    switch($_SESSION['operacion']){
        case 'eliminar': $alertas['exito'][] = 'Foto eliminada';break;
        case 'crear': $alertas['exito'][] = 'Foto agregada';break;
    }
    echo '<script type="text/javascript"> scroll(); </script>';
    array_pop($_SESSION);
}

include_once __DIR__ . '/../templates/alertas.php' ?>

<div class="fotos-servicio">
    <?php  
    $nombreProyecto = strtolower(str_replace(' ', '', $servicioNombre));
    $i = 1;

    while(file_exists("build/img/" . $nombreProyecto . $i . ".jpg")){ ?>
        <div class="contenedor-img">
            <img src="<?php echo "/build/img/" . $nombreProyecto . $i . ".jpg";?>">
            <form action="/servicios/fotos-eliminar" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="i" value="<?php echo $i; ?>">
                <input type="hidden" name="nombre" value="<?php echo $nombreProyecto; ?>">
                <input type="submit" class="boton-eliminar" value="🗑️">
            </form>
        </div>

    <?php $i++;
    } ?>
    <form id="formulario-foto" style="display:none" method="post" enctype="multipart/form-data">
        <input type="hidden" name="numeroImagen" value="<?php echo $i; ?>">
        <input type="file" name="imagen" id="imagen" style="display:none" accept="image/jpeg, image/png">
    </form>
    
    <img class="subir-imagen" src="/build/img/subirfoto.png">
</div>

<script type="text/javascript">
    const subirImagen = document.querySelector('.subir-imagen');
    const dialogoSubir = document.querySelector('#imagen');
    const formulario = document.querySelector('#formulario-foto');

    subirImagen.addEventListener('click', function(){
        dialogoSubir.click();
    });

    dialogoSubir.addEventListener('change', function(){
        formulario.submit();
    })

</script>