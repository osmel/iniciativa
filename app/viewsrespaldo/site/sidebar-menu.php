<div id="sidebar-menu">
    <span id="sidebar-search">
        <?php $this->load->view('site/inc/search-tool'); ?>
        <span class="promociones" style ="padding: .5em .5em .5em .7em; float:left;">
                        CATÁLOGO</span> 
    </span>

    <div class="accordion parent-accordion">
        <?php if ($categorias) { ?>
            <?php
            foreach ($categorias as $categoria) {
                $childs = $this->manager->lista_categorias($categoria->cid, 1);
                if ($childs) {
                    ?>
                    <h3 class="parent con-acordeon"><?php echo $categoria->nombre_categoria; ?></h3>
                    <div>
                        <ul class="accordion">
                            <?php
                            foreach ($childs as $child) {
                                $subchilds = $this->manager->lista_categorias($child->cid, 1);
                                if ($subchilds) {
                                    ?>
                                    <h3 class="child"><?php echo $child->nombre_categoria; ?></h3>
                                    <div class="accordion">
                                        <ul class="accordion">
                                            <?php foreach ($subchilds as $subchild) { ?>
                                                <li class="grandchild">
                                                    <a href="<?php echo base_url(); ?>catalogo/<?php echo $subchild->slug_categoria; ?>"><?php echo $subchild->nombre_categoria; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } else { ?>
                                    <a class="ui-accordion ui-accordion-header parent-link" href="<?php echo base_url(); ?>catalogo/<?php echo $child->slug_categoria; ?>">
                                        <h3 class="child">
                                            <?php echo ucwords($child->nombre_categoria); ?>
                                        </h3>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a class="ui-accordion ui-accordion-header parent-link" href="<?php echo base_url(); ?>catalogo/<?php echo $categoria->slug_categoria; ?>">
                        <h3 class="parent">
                            <?php echo $categoria->nombre_categoria; ?>
                        </h3>
                    </a>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
    <?php $this->load->view('site/inc/banner-sidebar'); ?>
</div>