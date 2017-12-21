<?php $this->load->view('site/header'); ?>
<div id="content">
    <div id="view-content">
        <?php $this->load->view('site/sidebar-menu'); ?>
        <div id="contenido">
            <div id="banners">
                <span class="liston-secciones" id="liston-catalogo"></span>
                <?php $this->load->view('site/inc/banners'); ?>
            </div>
            <div id="grid_container">
                <div id="grid">
                    <?php
                    if ($productos) {
                        foreach ($productos as $producto) {
                            ?>
                            <?php if ($producto->cid != 0) { ?>
                                <span class="producto" id="producto_<?php echo $producto->pid; ?>">
                                    <?php
                                        switch ($producto->tipo_producto) {
                                            case 1:
                                                echo '<span class="producto-nuevo"></span>';
                                                break;
                                            case 2:
                                                echo '<span class="producto-oferta"></span>';
                                                break;
                                        }
                                    ?>
                                    <a href="<?php echo base_url(); ?>detalle/<?php echo $producto->slug_categoria . '/' . $producto->slug_producto . '/' . $producto->slug_modelo_producto; ?>">
                                        <?php if ($producto->thumbs_producto) { ?>
                                            <img border="0" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 245); ?>" class="thumbnail_245_producto">
                                        </a>
                                    <?php } else { ?>
                                        <img border="0" src="<?php echo base_url(); ?>img/no_image.jpg" class="thumbnail_245_producto">
                                        </a>
                                    <?php } ?>
                                    <h3 class="grid_titulo"><?php echo $producto->nombre_producto; ?></h3>
                                    <?php if ($producto->modelo_producto) : ?><h4 class="grid_modelo"><?php echo strtoupper($producto->modelo_producto); ?></h4><?php endif; ?>
                                    <p class="grid_descripcion"><?php echo $producto->nombre_categoria; ?></p>
                                    <?php if($producto->precio_metro != 0) { ?>
                                        <p class="grid_precio">$<?php echo $producto->precio_metro; ?></p>
                                    <?php } else { ?>
                                        <p class="grid_precio">$<?php echo $producto->precio_rollo; ?></p>
                                    <?php } ?>
                                    <p class="add_carrito">
                                        <a onclick="showcarbutton(<?php echo $producto->pid; ?>);">
                                            <img border="0" src="<?php echo base_url(); ?>img/carrito_producto.png">
                                        </a>
                                    </p>
                                    <p class="botonadd">
                                        <a href="<?php echo base_url(); ?>detalle/<?php echo $producto->slug_categoria . '/' . $producto->slug_producto . '/' . $producto->slug_modelo_producto; ?>"><img border="0" src="<?php echo base_url(); ?>img/boton_addcar.png"></a>
                                    </p>
                                </span>
                            <?php }else { ?>

                                <span class="producto" id="producto_<?php echo $producto->pid; ?>">
                                    <a href="<?php echo base_url(); ?>detalle/sin-categoria/<?php echo $producto->slug_producto . '/' . $producto->slug_modelo_producto; ?>">
                                        <?php if ($producto->thumbs_producto) { ?>
                                            <img border="0" src="<?php echo base_url() . 'uploads/' . get_thumbnail($producto->thumbs_producto, 245); ?>" class="thumbnail_245_producto">
                                        </a>
                                    <?php } else { ?>
                                        <img border="0" src="<?php echo base_url(); ?>img/no_image.jpg" class="thumbnail_245_producto">
                                        </a>
                                    <?php } ?>
                                    <h3 class="grid_titulo"><?php echo $producto->nombre_producto; ?></h3>
                                    <?php if ($producto->modelo_producto) : ?><h4 class="grid_modelo"><?php echo strtoupper($producto->modelo_producto); ?></h4><?php endif; ?>
                                    <p class="grid_descripcion">sin-categoria</p>
                                    <p class="grid_precio">$<?php echo $producto->precio_metro; ?></p>
                                    <p class="add_carrito">
                                        <a onclick="showcarbutton(<?php echo $producto->pid; ?>);">
                                            <img border="0" src="<?php echo base_url(); ?>img/carrito_producto.png">
                                        </a>
                                    </p>
                                    <p class="botonadd">
                                        <a href="<?php echo base_url(); ?>detalle/sin-categoria<?php echo $producto->slug_producto . '/' . $producto->slug_modelo_producto; ?>"><img border="0" src="<?php echo base_url(); ?>img/boton_addcar.png"></a>
                                    </p>
                                </span>
                            <?php
                            }
                        }
                        ?>
                    <?php } else { ?>
                        <p>No hay artículos para mostrar</p>
                    <?php } ?>
                </div>
            </div>
            <div id="paginacion"><?php echo $paginacion; ?></div>
        </div>
    </div>
</div>
<?php $this->load->view('site/footer'); ?>