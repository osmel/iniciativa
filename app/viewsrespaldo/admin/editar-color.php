<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<h2>Editar color</h2>
				<?php $attr = array('id'=>'editcolor_form', 'name'=>'editcolor_form', 'method'=>'POST', 'autocomplete'=>'off'); ?>
				<?php echo form_open('admin/guardar_color_editado', $attr); ?>
					<span class="mini-bloque">
						<label for="nombre_color">Nombre </label>
						<input type="text" name="nombre_color" id="nombre_color" value="<?php echo set_value('nombre_color', $color->nombre_color); ?>" placeholder="Nombre del color">
						<em>Puedes asignarle un nombre personalizado a los colores.</em>
					</span>
					<span class="mini-bloque">
						<label for="hex_color">Color </label>
						<div id="colorPicker"></div>
						<input type="text" id="hex_color" name="hex_color" placeholder="Color" value="<?php echo set_value('hex_color', $color->hexadecimal_color); ?>" class="colorSelector" style="background-color:#<?php echo $color->hexadecimal_color; ?>">
						<div class="colorSelector"></div>
						<em>Aquí puedes seleccionar un color que más se parezca al color de tela que piensas dar de alta.</em>
					</span>
					<span class="mini-bloque final">
						<input type="hidden" name="color_uid" value="<?php echo $this->input->get('col_id'); ?>" >
						<input type="submit" name="guardar" value="Guardar">
					</span>
				<?php echo form_close(); ?>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>