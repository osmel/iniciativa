<?php
    /**
     * Módulo de búsqueda para poder poner en varias partes
     */
?>

    <?php
        $buscador = array('id'=>'seach_form', 'name'=>'search','method'=>'get','autocomplete'=>'off');
        echo form_open('busqueda', $buscador);
    ?>
        <input type="text" name="buscar" id="inputbuscar" size="4" placeholder="Buscar..." class="input-rounded">
        <input type="submit" id="box-input" value="">
        </span>
    <?php echo form_close(); ?>
