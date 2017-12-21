<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<span class="sidebar-bloque">
					<?php $this->load->view('admin/nueva-categoria'); ?>
				</span>
				<span class="list-table">
					<table align="center" border="1" cellpadding="0" cellspacing="0" class="list-grid" width="500">
						<tr>
							<th width="85%">Nombre de la categoría</th>
							<th width="5%">Editar</th>
							<th width="5%">Activar</th>
							<th width="5%">Borrar</th>
						</tr>
						<?php if(!$categorias){ ?>
							<tr>
								<td colspan="4">No existen categorías para mostrar</td>
							</tr>
						<?php }else{
							foreach($categorias as $categoria){ ?>
							<tr>
								<td><?php echo $categoria->nombre_categoria; ?></td>
								<td><a href="<?php echo base_url(); ?>admin/editar_categoria?cid=<?php echo $categoria->cid; ?>&amp;hash=<?php echo $this->encrypt->sha1($categoria->cid); ?>" class="ui-icon ui-icon-pencil"></a></td>
								<td><input type="checkbox" name="activar" value="<?php echo $categoria->status_categoria; ?>" <?php if($categoria->status_categoria == 1) echo "checked"; ?> onclick="activar_categoria('<?php echo $categoria->cid; ?>',<?php echo $categoria->status_categoria; ?>);"></td>
								<td><a href="#" class="ui-icon ui-icon-trash" onclick="borrar_categoria('<?php echo $categoria->cid; ?>','<?php echo $this->encrypt->sha1($categoria->cid); ?>','<?php echo base_url(); ?>admin/borrar_categoria')"></a></td>
							</tr>
						<?php }
						} ?>
					</table>
					<div id="paginacion"><?php echo $paginacion; ?></div>
					<em>* Las categorías hijas o subcategorías sólo son visibles al editar las categorías superiores o padre. <br /><br /><strong>NOTA: </strong>Es posible crear un árbol de categorías sólo de 3 niveles, si se agrega una cuarta categoría al nivel 4, este no aparecerá.</em>
				</span>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>