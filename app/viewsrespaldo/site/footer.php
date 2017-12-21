			<div id="footer">
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
            </span>
		</div>
	</div>
    
</body>
</html>