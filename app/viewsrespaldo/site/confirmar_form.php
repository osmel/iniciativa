<div id="container_confirm_form">
	<span class="logo_confirm_content">
		<img border="0" src="<?php echo base_url(); ?>img/logo.png" width="45%">
	</span>
	<span class="liston_titulo">Confirmación de pedido</span>
	<span id="errores_confirmacion" style="display:none"></span>
	<?php
		$formulario_pedido = array('id'=>'formulario_pedido','name'=>'formulario_pedido','method'=>'post','autocomplete'=>'off');
		echo form_open('procesar_pedido', $formulario_pedido);
	?>
		<span class="bloque_form_confirmacion">
			<label for="nombre_completo"><em class="leyenda_requerida">*</em>Nombre completo</label>
			<input id="nombre_completo" class="input_form_confirmacion" type="text" name="nombre_completo" value="<?php echo set_value('nombre_completo'); ?>" placeholder="Nombre completo">
		</span>
		<span class="bloque_form_confirmacion">
			<label for="correo_electronico"><em class="leyenda_requerida">*</em>Correo electrónico</label>
			<input id="correo_electronico" class="input_form_confirmacion" type="text" name="correo_electronico" value="<?php echo set_value('correo_electronico'); ?>" placeholder="Correo electrónico">
		</span>
		<span class="bloque_form_confirmacion">
			<label for="telefono"><em class="leyenda_requerida">*</em>Teléfono con lada</label>
			<input id="telefono" class="input_form_confirmacion" type="text" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Teléfono con lada">
		</span>
		<span class="bloque_form_confirmacion">
			<label for="telefono_celular">Celular</label>
			<input id="telefono_celular" class="input_form_confirmacion" type="text" name="telefono_celular" value="<?php echo set_value('telefono_celular'); ?>" placeholder="Celular">
		</span>
		<span class="bloque_form_confirmacion" id="tipo_envio">
			<span class="multiple">
				<input type="radio" name="entrega_pedido" value="1" checked onclick="tipoEnvio()" <?php echo set_radio('entrega_pedido', '1', TRUE); ?>>Recoger en sucursal
			</span>
			<span class="multiple">
				<input type="radio" name="entrega_pedido" value="2" onclick="tipoEnvio()" <?php echo set_radio('entrega_pedido', '2', FALSE); ?>>Envío a domicilio
			</span>
		</span>
		<span id="informacion_envio_domicilio"></span>
		<span class="bloque_form_confirmacion">
			<em class="leyenda_requerida">*Información requerida</em>
		</span>
		<span class="bloque_form_confirmacion" id="procesar_pedido">
			<input type="submit" name="procesar_pedido" value="Enviar">
		</span>
	<?php echo form_close(); ?>
</div>