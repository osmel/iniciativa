<h2>Agregar color</h2>
<?php $attr = array('id'=>'addcolor_form', 'name'=>'addcolor_form', 'method'=>'POST', 'autocomplete'=>'off','class'=>'sidebar_forms'); ?>
<?php echo form_open('admin/nuevo_color', $attr); ?>
	<span class="mini-bloque">
		<label for="nombre_color">Nombre </label>
		<input type="text" name="nombre_color" id="nombre_color" value="<?php echo set_value('nombre_color'); ?>" placeholder="Nombre del color">
		<em>Puedes asignarle un nombre personalizado a los colores.</em>
	</span>
	<span class="mini-bloque">
		<label for="hex_color">Color </label>
		<div id="colorPicker"></div>
		<input type="text" id="hex_color" name="hex_color" placeholder="Color" value="<?php echo set_value('hex_color'); ?>" class="colorSelector">
		<div class="colorSelector"></div>
		<em>Aquí puedes seleccionar un color que más se parezca al color de tela que piensas dar de alta.</em>
	</span>
	<span class="mini-bloque final">
		<input type="submit" name="guardar" value="Guardar">
	</span>
<?php echo form_close(); ?>