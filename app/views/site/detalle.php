<?php $this->load->view('site/header'); ?>
<script type="text/javascript">
    $(function() {
        // $(document).tooltip({position: {my: "center bottom-20", at: "center top", using: function(position, feedback) {
        //             $(this).css(position);
        //             $("<div>").addClass("arrow").addClass(feedback.vertical).addClass(feedback.horizontal).appendTo(this);
        //         }}});
               //$('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
                $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
    });
</script>
<div class="container" style="margin-top:8px">
    <!-- <div id="view-content"> -->
        <?php //$this->load->view('site/sidebar-menu'); ?>
        <!-- <div id="contenido"> -->
    <div class="col-xs-12 col-sm-12 col-md-12" id="detalle">    
        <div class="col-xs-12 col-sm-6 col-md-4">
            
                <?php
                    switch ($producto->tipo_producto) {
                        case 1:
                            echo '<span class="producto-nuevo prod-liston-detalle">NUEVO</span>';
                            break;
                        case 2:
                            echo '<span class="producto-oferta prod-liston-detalle">OFERTA</span>';
                            break;
                    }
                ?>
                <!-- <span class="destacada_container"> -->
                    <?php if ($producto->thumbs_producto) { ?>
                        <!-- <a class="gallery" href="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 800); ?>"><img id="img_producto" border="0" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 245); ?>" alt="" data-big="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 450); ?>" width="100%" ></a> -->
                        <img id="zoom_07" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 450); ?>" data-zoom-image="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 800); ?>"/>
                        <!-- <a class="gallery" href="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 1024); ?>"><img id="img_producto" border="0" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 245); ?>" alt="" width="100%" ></a> -->
                    <?php } else { ?>
                        <img id="img_producto" border="0" src="<?php echo base_url(); ?>img/no_image.jpg" alt="" data-big="<?php echo base_url(); ?>img/no_image.jpg" width="100%" >                                
                    <?php } ?>
                <!-- </span> -->
                <span class="help_text">Amplia la imagen pasando el mouse por encima</span>
                <?php if ($producto->galeria_producto) { ?>
                    <span class="gallery_model">
                        <?php
                        $galeria = json_decode($producto->galeria_producto);
                        $i = 0;
                        foreach ($galeria as $image) {
                            if ($i < 3) {
                                ?>
                                <a class="gallery" href="<?php echo base_url() . 'uploads/galerias/' . get_image_gallery($image, 800); ?>" num="<?php echo $producto->pid; ?>"><img border="0" src="<?php echo base_url() . 'uploads/galerias/' . get_image_gallery($image, 80); ?>" /></a>
                            <?php } else { ?>
                                <a class="gallery" href="<?php echo base_url() . 'uploads/galerias/' . get_image_gallery($image, 800); ?>" num="<?php echo $producto->pid; ?>"></a>
                                <?php
                            }
                            $i++;
                        }
                        ?>
                    </span>
                <?php } ?>
            
        </div> 

        <div class="col-xs-12 col-sm-6 col-md-4">
            <span class="info_producto">
                <h2><?php echo $producto->nombre_producto; ?></h2>
                <?php if ($producto->modelo_producto) : ?><h3 class="grid_modelo"><?php echo strtoupper($producto->modelo_producto); ?></h3><?php endif; ?>

                <span class="descripcion_producto"><?php echo $producto->descripcion_producto; ?></span></br>
                <?php if ($producto->metros_rollo) : ?><span class="descripcion_producto rollode"><?php echo "Rollo de: ".$producto->metros_rollo." mts."; ?></span><?php endif; ?>
                
                <?php
                $anadir_al_carrito = array('id' => 'descripcion_venta', 'name' => 'descripcion_producto_form', 'method' => 'post', 'autocomplete' => 'off');
                ?>
                <?php $cuidados = $this->manager->cuidados_asignados_detalle($producto->puid); ?>
                <?php if ($cuidados != NULL) { ?>
                    <span class="bloque_producto_detalle">
                        <label>Características de lavado</label>
                        <span id="cuidados">
                            <?php foreach($cuidados as $cuidado){ ?>
                                <span class="cuidados_lavado <?php echo $cuidado->icon; ?>" title="<?php echo $cuidado->cuidado; ?>"></span>
                            <?php } ?>
                        </span>
                    </span>
                <?php } ?>
            </span>    
        </div> 
        <div class="col-xs-12 col-sm-6 col-md-4">
            <span class="info_producto">
            <?php
            echo form_open('agregar_carrito', $anadir_al_carrito);
                ?>
                
                <span class="bloque_producto_detalle">
                    <?php if ($producto->colores_producto != 'false') { ?>
                        <!-- <label>Color</label> -->
                        <span id="colours">
                            <?php $colores = $this->manager->obtener_colores($producto->colores_producto); ?>
                            <?php foreach ($colores as $color) { ?>
                                <span class="thumbs_colors" data-toggle="tooltip" title="<?php echo $color->nombre_color; ?>">
                                    <input type="radio" id="tipo_color_<?php echo $color->color_uid; ?>" class="colores" name="tipo_color" value="<?php echo $color->color_uid; ?>" title="<?php echo $color->nombre_color; ?>">
                                    <label for="tipo_color_<?php echo $color->color_uid; ?>" style="background-color:#<?php echo $color->hexadecimal_color; ?>"></label>
                                </span>
                            <?php } ?>
                        </span>
                        <input type="hidden" name="colours" value="true">
                    <?php } else { ?>
                        <input type="hidden" name="colours" value="false">
                    <?php } ?>
                </span>
                <span class="bloque_producto_detalle multix">
                    
                    <?php if($producto->precio_metro != 0){ ?>
                        <div class="col-md-6">
                            <span>
                                <em>Precio por metro </em>
                                <p><?php echo "MXN $".$producto->precio_metro; ?></p>
                            </span>
                        </div>
                    <?php } ?>

                    <?php if($producto->metros_rollo != 0){ ?>
                        <?php $total_rollo = $producto->precio_rollo * $producto->metros_rollo; ?>
                    <?php } ?>

                    <?php if($producto->metros_rollo != 0){ ?>
                    <div class="col-md-6">
                        <span>
                            <em>Precio del metro por rollo </em>
                            <p><?php echo "MXN $".$producto->precio_rollo ; ?></p>
                        </span>
                    </div>
                    
                    <?php } ?>
                
                </span>
                <span class="bloque_producto_detalle">
                    <label for="tipo_venta">Tipo de venta</label>
                    <select name="tipo_venta">
                        <?php if($producto->precio_metro != 0) { ?>
                            <option value="1" selected>Metro</option>
                        <?php } ?>
                        <option value="2">Rollo</option>
                    </select>
                </span>
                <span class="bloque_producto_detalle">
                    <label for="cantidad_venta">Cantidad</label>
                    <input type="text" value="1" name="cantidad_venta" id="cantidad_venta">
                </span>
                
                <span class="bloque_producto_detalle">
                    <input type="button" id="add_to_car" name="add_to_car" onclick="addToCar()">
                    <input type="hidden" name="p_metro" value="<?php echo $producto->precio_metro; ?>" >
                    <input type="hidden" name="p_rollo" value="<?php echo $producto->precio_rollo; ?>" >
                    <input type="hidden" name="m_rollo" value="<?php echo $producto->metros_rollo; ?>" >
                    <input type="hidden" name="nombre_producto" value="<?php echo $producto->nombre_producto; ?>" >
                    <input type="hidden" name="modelo_producto" value="<?php echo $producto->modelo_producto; ?>" >
                    <input type="hidden" name="product_id" value="<?php echo $producto->pid; ?>" >
                    <input type="hidden" name="img_product" value="<?php echo get_thumbnail($producto->thumbs_producto, 80); ?>" >
                </span>
                <?php echo form_close(); ?>
        </div>    
            
               
    </div>
 </div>
<div class="container">
    <div class="col-md-12 gnral">
        
            
            <h2><span>Destacados</span></h2>
            
            <?php if($destacados){
                foreach($destacados as $destacado){ ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <span class="producto" id="producto_<?php echo $destacado->pid; ?>">
                            <?php
                                switch ($destacado->tipo_producto) {
                                    case 1:
                                        echo '<span class="producto-nuevo">NUEVO</span>';
                                        break;
                                    case 2:
                                        echo '<span class="producto-oferta">OFERTA</span>';
                                        break;
                                }
                            ?>
                            <a href="<?php echo base_url(); ?>detalle/<?php echo $destacado->slug_categoria.'/'.$destacado->slug_producto.'/'.$destacado->slug_modelo_producto; ?>">
                                <?php if($destacado->thumbs_producto){ ?>
                                    <img border="0" src="<?php echo base_url().'uploads/'.get_thumbnail($destacado->thumbs_producto, 245); ?>" class="thumbnail_245_producto">
                            </a>
                            <?php }else{ ?>
                                <img border="0" src="<?php echo base_url(); ?>img/no_image.jpg" class="thumbnail_245_producto">
                            </a>
                            <?php } ?>
                            <h3 class="grid_titulo"><?php echo $destacado->nombre_producto; ?></h3>
                            <?php if($destacado->modelo_producto) : ?><h4 class="grid_modelo"><?php echo strtoupper($destacado->modelo_producto); ?></h4><?php endif; ?>
                            <p class="grid_descripcion"><?php echo $destacado->nombre_categoria; ?></p>
                            <?php if($destacado->precio_metro != 0) { ?>
                                <p class="grid_precio">$<?php echo $destacado->precio_metro; ?></p>
                            <?php } else { ?>
                                <p class="grid_precio">$<?php echo $destacado->precio_rollo; ?></p>
                            <?php } ?>
                            <p class="add_carrito">
                                <a onclick="showcarbutton(<?php echo $destacado->pid; ?>);">
                                    <img border="0" src="<?php echo base_url(); ?>img/carrito_producto.png">
                                </a>
                            </p>
                            <p class="botonadd">
                                <a href="<?php echo base_url(); ?>detalle/<?php echo $destacado->slug_categoria.'/'.$destacado->slug_producto.'/'.$destacado->slug_modelo_producto; ?>"><img border="0" src="<?php echo base_url(); ?>img/boton_addcar.png"></a>
                            </p>
                        </span>
                    </div>
                <?php }
            }else{ ?>
                <p>No hay artículos para mostrar</p>
            <?php } ?>
    </div>
  </div>       <!-- </div> -->
  <!--   </div> -->
</div>
<?php $this->load->view('site/footer'); ?>