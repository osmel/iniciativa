<?php $this->load->view('admin/header'); ?>
	<div id="content">
		<div id="view-content">
			<?php $attr = array('id'=>'login_form', 'name'=>'login_form', 'method'=>'POST', 'autocomplete'=>'off'); ?>
			<?php echo form_open('manager/login_process', $attr); ?>
				<span class="bloque">
					<label for="username">Usuario: </label>
					<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Usuario">
				</span>
				<span class="bloque">
					<label for="passwd">Contraseña: </label>
					<input type="password" name="passwd" id="passwd" value="<?php echo set_value('username'); ?>" placeholder="Contraseña">
				</span>
				<span class="bloque forgot">
					<a href="<?php echo base_url(); ?>">Volver al sitio</a>
				</span>
				<span class="bloque final">
					<input type="submit" name="entrar" value="Entrar">
				</span>
			<?php echo form_close(); ?>
		</div>
	</div>
<?php $this->load->view('admin/footer'); ?>