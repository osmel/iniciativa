<?php $this->load->view('site/header'); ?>
		<div id="content">
			<div id="view-content">
				<?php $this->load->view('site/sidebar-menu'); ?>
				<div id="contenido">
					<div id="banners">
						<span class="liston-secciones" id="liston-contacto"></span>
						<div id="slideshow">
							<div id="carousel">
								<div><img border="0" src="<?php echo base_url(); ?>img/banner-contacto.jpg" width="100%" /></div>
							</div>
						</div>
					</div>
					<div class="summary">
						<p>Si tienes alguna duda con respecto a tu pedido o gustas contactar al equipo de <span class="blue_iniciativa">Iniciativa Textil</span> basta con que llenes el siguiente formulario y te contactaremos a la brevedad.</p>
					</div>
					<?php $this->load->view('site/contact_form'); ?>
					<div id="maps_address">
						<iframe src="https://www.google.com/maps/embed?pb=!1m5!3m3!1m2!1s0x85d1fecc63a3f591%3A0x6dbbfd5bb257490f!2sCalle+de+Venustiano+Carranza+131%2C+Centro%2C+Cuauht%C3%A9moc%2C+06060+Ciudad+de+M%C3%A9xico%2C+D.F.%2C+M%C3%A9xico!5e0!3m2!1ses-419!2s!4v1389892898407" width="620" height="280" frameborder="0" style="border:0"></iframe>
					</div>
				</div>
			</div>
		</div>
<?php $this->load->view('site/footer'); ?>