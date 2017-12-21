<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<table align="center" border="1" cellpadding="0" cellspacing="0" class="list-grid products" width="700">
					<tr>
						<th width="55%">Nombre del producto</th>
						<th width="35%">Modelo</th>
						<th width="5%">Editar</th>
						<th width="5%">Activar</th>
						<th width="5%">Borrar</th>
					</tr>
					<?php if(empty($productos)){ ?>
						<tr>
							<td colspan="4">No existen productos para mostrar</td>
						</tr>
					<?php }else{
						foreach($productos as $producto){ ?>
							<tr>
								<td><?php echo $producto->nombre_producto; ?></td>
								<td><?php if($producto->modelo_producto) echo strtoupper($producto->modelo_producto); else echo '-'; ?></td>
								<td><a href="<?php echo base_url(); ?>admin/editar_producto?pid=<?php echo $producto->puid; ?>&amp;hash=<?php echo $this->encrypt->sha1($producto->puid); ?>" class="ui-icon ui-icon-pencil"></a></td>
								<td><input type="checkbox" name="activar" value="<?php echo $producto->status_producto; ?>" <?php if($producto->status_producto == 1) echo "checked"; ?> onclick="publicarProducto('<?php echo $producto->puid; ?>',<?php echo $producto->status_producto; ?>);"></td>
								<td><a href="#" class="ui-icon ui-icon-trash" onclick="borrar_producto('<?php echo $producto->puid; ?>','<?php echo $this->encrypt->sha1($producto->puid); ?>','<?php echo base_url(); ?>admin/borrar_producto')"></a></td>
							</tr>
						<?php }
					} ?>
				</table>
				<div id="paginacion"><?php echo $paginacion; ?></div>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>