<h2>Agregar categoría</h2>
<?php $attr = array('id'=>'addcategory_form', 'name'=>'addcategory_form', 'method'=>'POST', 'autocomplete'=>'off','class'=>'sidebar_forms'); ?>
<?php echo form_open('admin/nueva_categoria', $attr); ?>
	<span class="mini-bloque">
		<label for="nombre_categoria">Nombre </label>
		<input type="text" name="nombre_categoria" id="nombre_categoria" value="<?php echo set_value('nombre_categoria'); ?>" placeholder="Nombre de la categoría">
		<em>El nombre es cómo aparecerá en el menú lateral del sitio.</em>
	</span>
	<span class="mini-bloque">
		<label for="orden_categoria">Orden </label>
		<input type="text" name="orden_categoria" id="orden_categoria" value="<?php echo set_value('orden_categoria'); ?>" placeholder="Orden de la categoría">
		<em>El orden es la forma ordenada de las categorías cómo aparecerá en el menú lateral del sitio.</em>
	</span>

	<span class="mini-bloque">
		<label for="categoria_padre">Superior </label>
		<select id="categoria_padre" name="categoria_padre">
			<option value="0">Ninguna</option>
			<?php if($lista_categorias){
				foreach($lista_categorias as $categoria){ ?>
					<option value="<?php echo $categoria->cid; ?>"><?php echo $categoria->nombre_categoria; ?></option>
					<?php
						$childs = $this->manager->lista_categorias($categoria->cid, 0);
						foreach($childs as $child){ ?>
							<option value="<?php echo $child->cid; ?>">&nbsp; - <?php echo $child->nombre_categoria; ?></option>
							<?php
								$subchilds = $this->manager->lista_categorias($child->cid, 0);
								foreach($subchilds as $subchild){ ?>
									<option value="<?php echo $subchild->cid; ?>">&nbsp; &nbsp; &nbsp;-- <?php echo $subchild->nombre_categoria; ?></option>
								<?php } ?>
							?>
						<?php }
					?>
			<?php }
			} ?>
		</select>
		<em>Las categorías pueden tener jerarquías. Podrías tener una categoría de Fibra, y por debajo las categorías Artificiales y Naturales. Totalmente opcional.</em>
	</span>
	<span class="mini-bloque">
		<label for="descripcion_categoria">Descripción </label>
		<textarea id="descripcion_categoria" name="descripcion_categoria" placeholder="Descripción"></textarea>
		<em>La descripción no suele mostrarse en el sitio, pero te puede ayudar para saber que tipo de productos tienes por categoría.</em>
	</span>
	<span class="mini-bloque final">
		<input type="submit" name="guardar" value="Guardar">
	</span>
<?php echo form_close(); ?>