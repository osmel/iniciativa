<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<h2>Editar categoría</h2>
				<?php $attr = array('id'=>'editcategory_form', 'name'=>'editcategory_form', 'method'=>'POST', 'autocomplete'=>'off'); ?>
				<?php echo form_open('admin/guardar_categoria_editada', $attr); ?>
					<span class="mini-bloque">
						<label for="nombre_categoria">Nombre </label>
						<input type="text" name="nombre_categoria" id="nombre_categoria" value="<?php echo set_value('nombre_categoria', $categoria->nombre_categoria); ?>" placeholder="Nombre de la categoría">
						<em>El nombre es cómo aparecerá en el menú lateral del sitio.</em>
					</span>

					<span class="mini-bloque">
						<label for="orden_categoria">Orden </label>
						<input type="text" name="orden_categoria" id="orden_categoria" value="<?php echo set_value('orden_categoria', $categoria->orden_categoria); ?>" placeholder="Orden de la categoría">
						<em>El orden es la forma ordenada de las categorías cómo aparecerá en el menú lateral del sitio.</em>
					</span>

					<span class="mini-bloque">
						<label for="categoria_padre">Superior </label>
						<select id="categoria_padre" name="categoria_padre">
							<option value="0">Ninguna</option>
							<?php if($lista_categorias){
								foreach($lista_categorias as $lcategoria){ ?>
									<option value="<?php echo $lcategoria->cid; ?>" <?php if($lcategoria->cid == $categoria->parent) echo "selected"; ?>><?php echo $lcategoria->nombre_categoria; ?></option>
									<?php
										$childs = $this->manager->lista_categorias($lcategoria->cid, 0);
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
						<textarea id="descripcion_categoria" name="descripcion_categoria" placeholder="Descripción"><?php echo $categoria->descripcion_categoria; ?></textarea>
						<em>La descripción no suele mostrarse en el sitio, pero te puede ayudar para saber que tipo de productos tienes por categoría.</em>
					</span>
					<span class="mini-bloque">
						<h3>Subcategorías</h3>
						<span class="list-table">
							<table align="center" border="1" cellpadding="0" cellspacing="0" class="list-grid" width="500">
								<tr>
									<th width="85%">Nombre de la categoría</th>
									<th width="5%">Editar</th>
									<th width="5%">Activar</th>
									<th width="5%">Borrar</th>
								</tr>
								<?php if(!$hijas){ ?>
									<tr>
										<td colspan="4">No existen categorías para mostrar</td>
									</tr>
								<?php }else{
									foreach($hijas as $hija){ ?>
									<tr>
										<td><?php echo $hija->nombre_categoria; ?></td>
										<td><a href="<?php echo base_url(); ?>admin/editar_categoria?cid=<?php echo $hija->cid; ?>&amp;hash=<?php echo $this->encrypt->sha1($hija->cid); ?>" class="ui-icon ui-icon-pencil"></a></td>
										<td><input type="checkbox" name="activar" value="<?php echo $hija->status_categoria; ?>" <?php if($hija->status_categoria == 1) echo "checked"; ?> onclick="activar_categoria('<?php echo $hija->cid; ?>',<?php echo $hija->status_categoria; ?>);"></td>
										<td><a href="#" class="ui-icon ui-icon-trash" onclick="borrar_categoria('<?php echo $hija->cid; ?>','<?php echo $this->encrypt->sha1($hija->cid); ?>','<?php echo base_url(); ?>admin/borrar_categoria')"></a></td>
									</tr>
								<?php }
								} ?>
							</table>
							<em>
								* Las categorías hijas o subcategorías sólo son visibles al editar las categorías superiores o padre. <br /><br />
								<strong>NOTA: </strong>
								Es posible crear un árbol de categorías sólo de 3 niveles, si se agrega una cuarta categoría al nivel 4, este no aparecerá.
							</em>
						</span>
					</span>
					<span class="mini-bloque final">
						<input type="hidden" name="catid" value="<?php echo $this->input->get('cid'); ?>">
						<input type="submit" name="guardar" value="Guardar">
					</span>
					<span class="mini-bloque">
						<a href="javascript:history.back(-1);">&#60;&#60; Regresar</a>
					</span>
				<?php echo form_close(); ?>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>