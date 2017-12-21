        <?php if ($categorias) { ?>
            <?php
            $i=0;
            foreach ($categorias as $categoria) {
                // print_r($categoria->nombre_categoria);    
                $childs = $this->manager->lista_categorias($categoria->cid, 1);
                if ($childs) {
                    ?>
                    <li class="dropdown yamm-fw">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <?php echo $categoria->nombre_categoria; ?>
                            <b class="caret"></b>
                        </a>
                            <ul class="dropdown-menu">
                                <li class="grid-demo">
                                    <div class="row megamen">
                                        
                                        <?php                                       
                                            
                                            foreach ($childs as $prueba => $child) {
                                                // $i=0;
                                                $i++;
                                                
                                                    
                                                // echo $i;
                                                
                                                
                                                $subchilds = $this->manager->lista_categorias($child->cid, 1);
                                                if ($subchilds) { ?>                                                    
                                                        
                                                     
                                                            <?php foreach ($subchilds as $subchild) { 
                                                                $i++;
                                                               if (($i % 10==0)or($i == 0)){                                                      
                                                        ?>
                                                                
                                                                <?php
                                                            } 
                                                    
                                                                ?>
                                                                <div class="col-xs-12 col-sm-3">
                                                                   <a href="<?php echo base_url(); ?>catalogo/<?php echo $subchild->slug_categoria; ?>"><?php echo $subchild->nombre_categoria; ?></a>
                                                                </div>
                                                            <?php } ?>
                                                    
                                                    
                                                <?php } else {                                                     
                                                    if (($i % 10==0)&&($i != 0)){                                                     
                                                        ?>
                                                     
                                                    <?php
                                                } 
                                                    ?>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <a href="<?php echo base_url(); ?>catalogo/<?php echo $child->slug_categoria; ?>">
                                                            <?php echo ucwords($child->nombre_categoria); ?>                                                       
                                                        </a>
                                                    </div>
                                                    <?php
                                                }

                                            }
                                            ?>
                                         
                                    </div>                
                                </li>
                            </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="<?php echo base_url(); ?>catalogo/<?php echo $categoria->slug_categoria; ?>">
                            <?php echo $categoria->nombre_categoria; ?>                        
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        <?php } ?>
   