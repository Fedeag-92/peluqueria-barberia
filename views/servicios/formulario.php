<div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" placeholder="Nombre Servicio" name="nombre" value="<?php echo $servicio->nombre; ?>">
</div>
<div class="campo">
    <label for="precio">Precio</label>
    <input type="number" id="precio" placeholder="Precio Servicio" name="precio" value="<?php echo $servicio->precio; ?>">
</div>
<div class="campo">
    <label for="oferta">Oferta(%)</label>
    <input type="number" id="oferta" placeholder="Descuento Servicio" name="oferta" value="<?php echo $servicio->oferta; ?>">
</div>
<div class="campo">
    <label for="demora">Demora(hs): </label>
    <select id="demora" name="demora">
        <option value="" disabled>--:--</option>
        <?php
        $i = 0;
        $max = 5;
        $hora = substr($servicio->demora, 1, 4);
        while ($i < $max) {
            $time = $i . ':00';
            $time15 = $i . ':15';
            $time30 = $i . ':30';
            $time45 = $i . ':45';
            $id1 = 't' . $i . '00';
            $id2 = 't' . $i . '15';
            $id3 = 't' . $i . '30';
            $id4 = 't' . $i . '45';
        ?>
            <option id="<?php echo $id1 ?>" value="<?php echo $time ?>" <?php echo $hora  == $time ? 'selected' : '' ?>><?php echo $time ?></option>
            <option id="<?php echo $id2 ?>" value="<?php echo $time15 ?>" <?php echo $hora  == $time15 ? 'selected' : '' ?>><?php echo $time15 ?></option>
            <option id="<?php echo $id3 ?>" value="<?php echo $time30 ?>" <?php echo $hora  == $time30 ? 'selected' : '' ?>><?php echo $time30 ?></option>
            <option id="<?php echo $id4 ?>" value="<?php echo $time45 ?>" <?php echo $hora  == $time45 ? 'selected' : '' ?>><?php echo $time45 ?></option>
        <?php
            ++$i;
        }
        ?>
    </select>
</div>