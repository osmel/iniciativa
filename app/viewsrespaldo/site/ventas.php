<?php $this->load->view('site/header'); ?>
		<div id="content">
			<div id="view-content">
				<?php $this->load->view('site/sidebar-menu'); ?>
				<div id="contenido">
					<div id="banners">
						<span class="liston-secciones" id="liston-ventas"></span>
						<div id="slideshow">
							<div id="carousel">
								<div><img border="0" src="<?php echo base_url(); ?>img/banner-ventas.jpg" width="100%"/></div>
							</div>
						</div>
					</div>
					<div class="summary">
						<h2>Pasos a seguir para compras en l&iacute;nea:</h2>
						<span class="infograf_venta">
							<span class="numeric">1</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_01.jpg">
							<p>Encuentra tus telas.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">2</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_02.jpg">
							<p>Selecciona el tipo, color, cantidad de tela que<br />deseas pedir y a&ntilde;ade a tu carrito de pedidos.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">3</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_03.jpg">
							<p>Concluye tu pedido o sigue navegando.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">4</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_04.jpg">
							<p>Revisa tu pedido y llena el formulario con tus datos.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">5</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_05.jpg">
							<p>Se te contactar&aacute; v&iacute;a telef&oacute;nica o correo<br />electr&oacute;nico para confirmar tu pedido.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">6</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_06.jpg">
							<p>Haz el pago con las distintas modalidades<br />que <span class="blue_iniciativa">Iniciativa Textil</span> te ofrece.</p>
						</span>
						<span class="infograf_venta">
							<span class="numeric">7</span>
							<img border="0" src="<?php echo base_url(); ?>img/pasos_venta_07.jpg">
							<p>Recibe tu pedido en tu domicilio<br />o rec&oacute;gelo directamente con nosotros.</p>
						</span>
					</div>
				</div>
			</div>
		</div>
<?php $this->load->view('site/footer'); ?>