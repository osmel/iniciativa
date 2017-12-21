<?php $attr = array(
	'id' => 'contact_form',
	'name' => 'contact_form',
	'method' => 'POST',
	'autocomplete' => 'off'
	); ?>
<?php echo form_open('procesar_contacto', $attr); ?>
	<span class="bloque_contacto doble">
		<input type="text" name="nombre" placeholder="*Tu nombre" value="<?php echo set_value('nombre'); ?>">
		<input type="text" name="email" placeholder="*E-mail" value="<?php echo set_value('email'); ?>">
	</span>
	<span class="bloque_contacto doble">
		<input type="text" name="telefono_celular" placeholder="*Teléfono celular" value="<?php echo set_value('telefono_celular'); ?>">
		<input type="text" name="telefono" placeholder="Tel&eacute;fono" value="<?php echo set_value('telefono'); ?>">
	</span>
	<span class="bloque_contacto">
		<textarea name="mensaje" rows="4" cols="80" maxlength="2000" placeholder="*Mensaje"><?php echo set_value('mensaje'); ?></textarea>
	</span>
	<span class="bloque_contacto">
		<input type="submit" name="enviar_formulario" value="Enviar">
		<em class="info_user">*Campos obligatorios</em>
	</span>
<?php echo form_close(); ?>