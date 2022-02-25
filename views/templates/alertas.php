<?php foreach($alertas as $key => $mensajes): 
    foreach($mensajes as $mensaje): ?>
        <div class="alerta <?php echo $key; ?>">
            <?php 
            if($key == 'exito'){
                echo '<ion-icon name="checkmark-circle-outline"></ion-icon>';
            }else if($key == 'error'){
                echo '<ion-icon name="alert-circle-outline"></ion-icon>';
            }else{
                echo '<ion-icon name="warning-outline"></ion-icon>';
            }
            echo $mensaje; ?>
        </div>
    <?php endforeach;
endforeach; ?>