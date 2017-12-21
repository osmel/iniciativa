			<!-- <div id="footer">
                <span id="footer-copy">
                    <span id="footer-logo"></span>
                </span>
                </span>
                <span class="footer-sombra"></span>
                <span class="footer-contenido">
                    <span id="footer-menu">
                        <?php echo $menu_footer; ?>
                    </span>
                    <span id="contenedor-sombra">
                        <span class="footer-sombra-horizontal"></span>
                    </span>
                    <span id="footer-contacto">
                        <span id="telefonos">
                            <span class="icon-phone"></span>
                            <span class="number-phones">
                                <span>55422391</span>
                                <span>55221237</span>
                            </span>
                        </span>
                        <span id="direccion">
                            <span class="icon-map"></span>
                            <span class="address">Calle de Venustiano Carranza 131-1 Centro, Delegación Cuauhtémoc C.P. 06060 D.F., México</span>
                        </span>
                        <span id="footer-correo">
                            <span class="icon-correo"></span>
                            <a href="mailto:contacto@iniciativatextil.com" target="_blank">contacto@iniciativatextil.com</a>
                            <span class="sprite facebook-footer"></span><a id="facebook-link" href="https://www.facebook.com/IniciativaTex?fref=ts" target="_blank">/IniciativaTex</a>
                        </span>
                    </span>
                </span>
                <span id="footer-news">
                    Entérate de nuestras promociones
                    <span class="flecha-promo-sm"></span>
                    <?php $this->load->view('site/inc/newsletter-tool-footer'); ?>
                    <span class="powerby">
                        <span class="developer">Desarrollador por:</span>
                        <a href="http://estrategasdigitales.com/proceso.php?a=01" target="_blank"><span class="estrategas-logo"></span></a>
                    </span>
                </span>
			</div>
            <span id="text-footer">
                Copyright <?php $datestring = "%Y"; $time = time(); echo mdate($datestring, $time); ?> &bull; Iniciativa Textil &bull; Derechos Reservados &bull; <a href="<?php echo base_url(); ?>aviso-privacidad" target="_blank">Aviso de privacidad</a>
            </span> -->
		<!-- </div> -->
	</div>
    <!--  NUEVO FOOTER -->
    <div class="row footer1">
      <div class="container">
        <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4 foo1">
          <img class="footer_logo" src="<?php echo base_url(); ?>img/nuevo/logo2.png">
        </div>
        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 foo2">
          <ul class="list_footer">
            <li><a href="<?php echo base_url(); ?>home">Home</a></li>
            <li><a href="<?php echo base_url(); ?>nosotros">Nosotros</a></li>
            <li><a href="<?php echo base_url(); ?>ventas">Ventas</a></li>
            <li><a href="<?php echo base_url(); ?>licitaciones">Licitaciones</a></li>
            <li><a href="<?php echo base_url(); ?>catalogo">Catálogo</a></li>
            <li><a href="<?php echo base_url(); ?>contacto">Contacto</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 foot_info foo3">
          <div class="foot_1">
            <i class="fa fa-phone" aria-hidden="true"></i>
              <div class="foot_cont_info">
                <p>55422391</p>
                <p>55221237</p>
              </div>
              <i class="fa fa-whatsapp" aria-hidden="true"></i>
                <div class="foot_cont_info" style="margin-top: 2px;">
                  <p>5549265421</p>
                </div>
          </div>
          <div class="foot_2">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <div class="foot_cont_info">
              <p>Calle de Venustiano Carranza 131-1</p>
              <p>Centro, Delegación Cuauhtémoc</p>
              <p>C.P. 06060 D.F., México</p>
            </div>
          </div>
          <div class="foot_3">
            <div class="foot_cont_info">
              <i class="fa fa-envelope" style="font-size: 14px !important;" aria-hidden="true"></i><a href="mailto:contacto@iniciativatextil.com">contacto@iniciativatextil.com</a>
              </div>
          </div>
          <div class="foot_4">
            <div class="foot_cont_info">
              <i class="fa fa-facebook" aria-hidden="true"></i><a href="https://www.facebook.com/IniciativaTex" target="_blank">/IniciativaTex</a>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 foo4">
          <span class="txt_entera">Entérate de nuestras promociones</span>
          <?php $this->load->view('site/inc/newsletter-tool'); ?>
        </div>        
      </div>
    </div>
    <div class="row footer2">
      <div class="container">
        <div class="col-md-6 center">
          <span class="txt_footabajo">Copyright 2016  .  Iniciativa Textil  .  Derechos Reservados</span>
        </div>
        <div class="col-md-6 text-right">
          <span class="txt_footabajo">Desarrollado por <a href="http://estrategasdigitales.com/" target="_blank">Estrategas Digitales</a></span>
        </div>
      </div>
    </div>
    <script>
     $("#zoom_07").elevateZoom({
  zoomType              : "lens",
  lensShape : "round",
  lensSize    : 200
});

    </script>
    <!-- FIN NUEVO FOOTER -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    
</body>
</html>