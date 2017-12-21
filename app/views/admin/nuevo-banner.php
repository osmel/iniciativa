<h2>Agregar banner</h2>
<?php $attr = array('id'=>'addbanner_form', 'name'=>'addbanner_form', 'method'=>'POST', 'autocomplete'=>'off','class'=>'sidebar_forms'); ?>
<?php echo form_open_multipart('admin/nuevo_banner', $attr); ?>
	<span class="mini-bloque">
		<label for="nombre_banner">Nombre </label>
		<input type="text" name="nombre_banner" id="nombre_banner" value="<?php echo set_value('nombre_banner'); ?>" placeholder="Nombre del banner">
		<em>El nombre sirve para que el contenido sea agregado por los buscadores.</em>
	</span>
	<span class="mini-bloque">
		<label for="link_banner">Link </label>
		<input type="text" name="link_banner" id="link_banner" value="<?php echo set_value('link_banner'); ?>" placeholder="Link del banner">
		<em>Con este campo, puedes agregar un link al banner el formato del link debe ser (http://dominio.com).</em>
	</span>
	<span class="mini-bloque">
		<label for="img_banner">Imagen </label>
		<input type="file" name="img_banner" id="img_banner">
		<em>Esta es la imagen que se mostrará en el carrusel del Home y de la sección Catálogo de tu sitio.</em>
	</span>
	<span class="mini-bloque">
		<label for="descripcion_banner">Descripción </label>
		<textarea id="descripcion_banner" name="descripcion_banner" placeholder="Descripción"></textarea>
		<em>La descripción no suele mostrarse en el sitio, pero te puede ayudar para saber que tipo de promoción estás ofreciendo.</em>
	</span>
	<span class="mini-bloque final">
		<input type="submit" name="guardar" value="Guardar">
		<em>El código de promoción se generará automáticamente.</em>
	</span>
<?php echo form_close(); ?>