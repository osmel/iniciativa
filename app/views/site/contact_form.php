<?php $attr = array(
	'id' => 'contact_form',
	'name' => 'contact_form',
	'method' => 'POST',
	'autocomplete' => 'off'
	); ?>
<?php echo form_open('procesar_contacto', $attr); ?>
<div class="col-md-12 conc sinborde">
	<!-- <span class="bloque_contacto doble"> -->
	<div class="col-xs-12 col-sm-6 col-md-6 leftcero">
		<input type="text" name="nombre" placeholder="*Tu nombre" value="<?php echo set_value('nombre'); ?>">
	</div>	
	<div class="col-xs-12 col-sm-6 col-md-6 leftright">
		<input type="text" name="email" placeholder="*E-mail" value="<?php echo set_value('email'); ?>">
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 leftcero">
	<!-- </span> -->
<!-- 	<span class="bloque_contacto doble"> -->
		<input type="text" name="telefono_celular" placeholder="*Teléfono celular" value="<?php echo set_value('telefono_celular'); ?>">
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6">	
		<input type="text" name="telefono" placeholder="Tel&eacute;fono" value="<?php echo set_value('telefono'); ?>">
	<!-- </span> -->
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 leftcero">	
		<span class="bloque_contacto">
			<textarea name="mensaje" rows="4" cols="80" maxlength="2000" placeholder="*Mensaje"><?php echo set_value('mensaje'); ?></textarea>
		</span>
		<span class="bloque_contacto">
			<input type="submit" name="enviar_formulario" value="Enviar">
			<em class="info_user">*Campos obligatorios</em>
		</span>
	</div>
</div>
<?php echo form_close(); ?>