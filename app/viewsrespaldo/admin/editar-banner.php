<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<h2>Editar banner</h2>
				<?php $attr = array('id'=>'editbanner_form', 'name'=>'editbanner_form', 'method'=>'POST', 'autocomplete'=>'off'); ?>
				<?php echo form_open_multipart('admin/guardar_banner_editado', $attr); ?>
					<span class="mini-bloque">
						<label for="nombre_banner">Nombre </label>
						<input type="text" name="nombre_banner" id="nombre_banner" value="<?php echo set_value('nombre_banner', $banner->nombre_banner); ?>" placeholder="Nombre del banner">
						<em>El nombre sirve para que el contenido sea agregado por los buscadores.</em>
					</span>
					<span class="mini-bloque">
						<label for="link_banner">Link </label>
						<input type="text" name="link_banner" id="link_banner" value="<?php echo set_value( 'link_banner', $banner->link ); ?>" placeholder="Link del banner">
						<em>Con este campo, puedes agregar un link al banner el formato del link debe ser (http://dominio.com).</em>
					</span>
					<span class="mini-bloque">
						<label>Imagen del banner </label>
						<img border="0" src="<?php echo base_url().'uploads/banners/'.get_thumbnail( $banner->img_banner, 698 ); ?>" />
					</span>
					<span class="mini-bloque">
						<label for="img_banner">Imagen </label>
						<input type="file" name="img_banner" id="img_banner">
						<em>Esta es la imagen que se mostrará en el carrusel del Home y de la sección Catálogo de tu sitio.</em>
					</span>
					<span class="mini-bloque">
						<label for="descripcion_banner">Descripción </label>
						<textarea id="descripcion_banner" name="descripcion_banner" placeholder="Descripción"><?php echo $banner->descripcion_banner; ?></textarea>
						<em>La descripción no suele mostrarse en el sitio, pero te puede ayudar para saber que tipo de promoción estás ofreciendo.</em>
					</span>
					<span class="mini-bloque final">
						<input type="hidden" name="banner_id" value="<?php echo $this->input->get('buid'); ?>">
						<?php if($banner->img_banner) : ?>
							<input type="hidden" name="img_banner" value="<?php echo get_thumbnail($banner->img_banner, 698); ?>" >
						<?php endif; ?>
						<input type="submit" name="guardar" value="Guardar">
						<em>El código de promoción se generará automáticamente.</em>
					</span>
				<?php echo form_close(); ?>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>