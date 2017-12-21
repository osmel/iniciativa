<?php $this->load->view('admin/header'); ?>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea#descripcion_producto",
        theme: "modern",
        language: "es",
        toolbar: "undo redo",
        plugins: [
            ""
        ],
        statusbar: false,
        menubar: false,
        force_p_newlines: false
    });
    $(document).ready(function() {
        mostrarColores(null, "#");
        var alfabeto = "#ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        for (var i = 0; i < alfabeto.length; i++) {
            if (i === 0) {
                var enlace = "<a onclick='mostrarColores(this,0);' style='text-decoration:underline;margin-top:5px;cursor:pointer;display:inline-block;'>" + alfabeto.charAt(i) + "</a><br />";
            } else {
                var enlace = "<a onclick='mostrarColores(this,0);' style='margin-top:5px;cursor:pointer;display:inline-block;'>" + alfabeto.charAt(i) + "</a><br />";
            }
            $('#coloresSeccion #alfabetoColores').append(enlace);
        }
        ;
    });
    function mostrarColores(ele, indice) {
        if (indice === 0) {
            letra = $(ele).html();
        } else {
            letra = indice;
        }
        $('#coloresSeccion #alfabetoColores a').css('text-decoration', '');
        $(ele).css('text-decoration', 'underline');
        $('#lista_colores').html('');
        $.ajax({
            dataType: "json",
            type: 'POST',
            url: '<?php echo base_url(); ?>admin/coloresAjax', //Realizaremos la petición al metodo list_dropdown del controlador match
            data: {indiceColor: letra}, //Pasaremos por parámetro POST el id del torneo
            success: function(resp) {
                for (i = 0; i < resp.length; i++) {
                    var opcion = '<option style = "background-color:#' + resp[i].hexadecimal_color + '" value = "' + resp[i].color_uid + '" >' + resp[i].nombre_color + '</option>';
                    $('#lista_colores').append(opcion);
                }
            }
        });
    }
</script>
<div id="content">
    <div id="view-content">
        <h2>Editar producto</h2>
        <?php $attr = array('id' => 'editproduct_form', 'name' => 'editproduct_form', 'method' => 'POST', 'autocomplete' => 'off', 'class' => 'sidebar_forms'); ?>
        <?php echo form_open_multipart('admin/guardar_producto_editado', $attr); ?>
        <span class="mini-bloque">
            <label>Imagen del producto </label>
            <?php if ($producto->thumbs_producto) { ?>
                <img border="0" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 245); ?>" />
            <?php } else { ?>
                <img border="0" src="<?php echo base_url(); ?>img/no_image.jpg" />
            <?php } ?>
        </span>
        <span class="mini-bloque multiples">
            <label for="nombre_producto">Nombre </label>
            <input type="text" name="nombre_producto" id="nombre_producto" value="<?php echo set_value('nombre_producto', $producto->nombre_producto); ?>" placeholder="Nombre del producto">
            <em>Este es el nombre del producto o tela.</em>
        </span>
        <span class="mini-bloque">
            <label for="categoria">Categoría </label>
            <?php $pcategorias = $this->manager->categorias_asignadas($producto->puid); ?>
            <select id="categoria" name="categoria[]" multiple>
                <?php if (in_array(0, $pcategorias)) { ?>
                    <option value="0" selected>Sin categoría</option>
                <?php } else { ?>
                    <option value="0">Sin categoría</option>
                <?php } ?>
                <?php
                if ($lista_categorias) {
                    foreach ($lista_categorias as $categoria) {
                        $childs = $this->manager->lista_categorias($categoria->cid, 0);
                        ?>
                        <option value="<?php echo $categoria->cid; ?>" <?php if($childs){ echo 'disabled="disabled"'; } if (in_array($categoria->cid, $pcategorias)) echo "selected"; ?>><?php echo $categoria->nombre_categoria; ?></option>
                        <?php
                        foreach ($childs as $child) {
                            $subchilds = $this->manager->lista_categorias($child->cid, 0);
                            ?>
                            <option value="<?php echo $child->cid; ?>" <?php if($subchilds){ echo 'disabled="disabled"'; } if (in_array($child->cid, $pcategorias)) echo "selected"; ?>>&nbsp; - <?php echo $child->nombre_categoria; ?></option>
                            <?php
                            foreach ($subchilds as $subchild) {
                                ?>
                                <option value="<?php echo $subchild->cid; ?>" <?php if (in_array($subchild->cid, $pcategorias)) echo "selected"; ?>>&nbsp; &nbsp; &nbsp;-- <?php echo $subchild->nombre_categoria; ?></option>
                            <?php } ?>
                            ?>
                        <?php }
                        ?>
                        <?php
                    }
                }
                ?>
            </select>
            <em>Selecciona una categoría para el producto, ten en cuenta si una categoría tiene subcateogías (hijos) debes asignarle la categoría hijo o nieto al producto.</em>
        </span>
        <span class="mini-bloque">
            <label for="descripcion_producto">Descripción </label>
            <textarea id="descripcion_producto" name="descripcion_producto" placeholder="Descripción"><?php echo set_value('descripcion_producto', $producto->descripcion_producto); ?></textarea>
            <em>Este texto aparecerá en el detalle del producto.</em>
        </span>
        <span class="mini-bloque multiples">
            <span>
                <label for="modelo_producto">Modelo del producto </label>
                <input type="text" name="modelo_producto" id="modelo_producto" value="<?php echo set_value('modelo_producto', $producto->modelo_producto); ?>" placeholder="Modelo del producto">
            </span>
            <span>
                <label for="precio_metro_producto">Precio por metro </label>
                <input type="text" name="precio_metro_producto" id="precio_metro_producto" value="<?php echo set_value('precio_metro_producto', $producto->precio_metro); ?>" placeholder="Precio por metro del producto">
            </span>
            <span>
                <label for="precio_rollo_producto">Precio por rollo </label>
                <input type="text" name="precio_rollo_producto" id="precio_rollo_producto" value="<?php echo set_value('precio_rollo_producto', $producto->precio_rollo); ?>" placeholder="Precio por rollo del producto">
            </span>
             <span>
                <label for="metros_rollo_producto">Metros por rollo </label>
                <input type="text" name="metros_rollo_producto" id="metros_rollo_producto" value="<?php echo set_value('metros_rollo_producto', $producto->metros_rollo); ?>" placeholder="Metros por rollo del producto">
            </span>
        
            <span>
                <label for="imagen_producto">Imagen destacada </label>
                <input type="file" name="imagen_producto" id="imagen_producto">
            </span>
            <em>Esta informaci&oacute;n aparecer&aacute; en el detalle del producto.</em>
        </span>
        <span class="mini-bloque multiples">
            <span>
                <label for="modelo_producto">Producto destacado </label>
                <input type="checkbox" name="producto_destacado" id="producto_destacado" value="1" <?php if ($producto->destacado == 1) echo "checked"; ?>> Si
            </span>
            <span>
                <label for="precio_metro_producto">Tipo de producto </label>
                <?php
                    $tipo = array('0'=>'Normal', '1'=>'Nuevo', '2'=>'Descuento');
                    echo form_dropdown('tipo_producto', $tipo, $producto->tipo_producto, 'id="tipo_producto"');
                ?>
            </span>
            <em>Esta informaci&oacute;n aparecer&aacute; en el detalle del producto.</em>
        </span>
        <span class="mini-bloque">
            <span>
                <label for="lavado">Características de Lavado <em>Presiona Ctrl en Windows / CMD en Mac para seleccionar más de una característica.</em></label>
                <?php $cuidados = $this->manager->lista_cuidados(); $pcuidados = $this->manager->cuidados_asignados($producto->puid); ?>
                <select name="lavado[]" id="lavado" class="select" multiple>
                    <?php if (in_array('0', $pcuidados)) { ?>
                        <option value="0" selected>Ninguno</option>
                    <?php } else { ?>
                        <option value="0">Ninguno</option>
                    <?php } ?>
                    <?php if ($cuidados != NULL) { foreach($cuidados as $cuidado) { ?>
                        <option value="<?php echo $cuidado->sku_uid; ?>"  <?php if($pcuidados){ if (in_array($cuidado->sku_uid, $pcuidados)) echo "selected"; } ?>><?php echo $cuidado->cuidado; ?></option>
                    <?php } } ?>
                </select>
            </span>
            <em>Esta informaci&oacute;n aparecer&aacute; en el detalle del producto.</em>
        </span>
        <span class="mini-bloque">
            <?php
            if ($producto->galeria_producto) {
                $galeria = json_decode($producto->galeria_producto);
                foreach ($galeria as $image) {
                    ?>
                    <img border="0" src="<?php echo base_url() . 'uploads/galerias/' . get_image_gallery($image, 80); ?>" />
                    <?php
                }
            }
            ?>
        </span>
        <span class="mini-bloque" id="galeria_producto">
            <input type="file" name="galeria_producto_files[]" id="galeria_producto_files" multiple />
            <span style="width:100%;margin-top:8px;display:block;">
                <input style="display:block;width:25px;float:left;height:15px;margin-top:0px;margin-left:30px;" type="radio" name="group2" id="group2" checked value="Nuevos">
                <label style="float:left;">Reemplazar Im&aacute;genes Existentes</label>
                <input style="display:block;width:25px;float:left;height:15px;margin-top:0px;margin-left:30px;" type="radio" name="group2" id="group2" value="Agregar">
                <label style="float:left;">Agregar a Im&aacute;genes Existentes</label>
            </span>
            <br /><br />
            <em>Puedes agregar galerías de tus productos y estas se mostrarán en el detalle de cada producto, puedes adjuntar hasta 20 archivos al mismo tiempo sin sobre pasar el límite de 8MB.</em>
        </span>
        <span class="mini-bloque multiples">
            <span id="coloresSeccion">
                <label id="alfabetoColores" ></label>
            </span>
            <span>
                <label for="color_producto">Colores </label>
                <select name="colores[]" id="lista_colores" multiple class="select"></select>
            </span>
            <span id="addremove">
                <input type="button" name="agregar_color" value=">>" id="agregar_color">
                <input type="button" name="quitar_color" value="<<" id="quitar_color">
            </span>
            <span>
                <label for="color_producto">Colores seleccionados </label>
                <select name="colores_seleccionados[]" id="colores_seleccionados" multiple class="select">
                    <?php
                    if ($producto->colores_producto != "false") {
                        $colores = $this->manager->obtener_colores($producto->colores_producto);
                        ?>
                        <?php foreach ($colores as $color) { ?>
                            <option style="background-color:#<?php echo $color->hexadecimal_color; ?>" value="<?php echo $color->color_uid; ?>" selected><?php echo $color->nombre_color; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </span>
            <em>Los colores están filtrados por letra del alfabeto.</em>
            <em>Los colores podr&aacute;n ser seleccionados por los clientes para hacer m&aacute;s detallados los pedidos.</em>
        </span>
        <span class="mini-bloque final">
            <input type="submit" name="guardar" value="Guardar">
            <?php if ($producto->imagen_producto) : ?>
                <input type="hidden" name="img_producto" value="<?php echo $producto->imagen_producto; ?>" >
            <?php endif; ?>
            <input type="hidden" name="uuid_producto" value="<?php echo $this->input->get('pid'); ?>" >
        </span>
        <?php echo form_close(); ?>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>