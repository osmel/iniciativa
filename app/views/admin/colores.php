<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<span class="sidebar-bloque">
					<?php $this->load->view('admin/nuevo-color'); ?>
				</span>
				<span class="list-table">
					<table align="center" border="1" cellpadding="0" cellspacing="0" class="list-grid" width="500">
						<tr>
							<th width="85%">Nombre del color</th>
							<th width="5%">Muestra</th>
							<th width="5%">Editar</th>
							<th width="5%">Borrar</th>
						</tr>
						<?php if(empty($colores)){ ?>
							<tr>
								<td colspan="4">No existen colores para mostrar</td>
							</tr>
						<?php }else{ ?>
							<?php foreach($colores as $color){ ?>
								<tr>
									<td><?php echo $color->nombre_color; ?></td>
									<td><div style="background-color:#<?php echo $color->hexadecimal_color; ?>;display:block;width:15px;height:15px;margin:0 auto;"></div></td>
									<td><a href="<?php echo base_url(); ?>admin/editar_color?col_id=<?php echo $color->color_uid; ?>&amp;hash=<?php echo $this->encrypt->sha1($color->color_uid); ?>" class="ui-icon ui-icon-pencil"></a></td>
									<td><a href="#" class="ui-icon ui-icon-trash" onclick="borrar_color('<?php echo $color->color_uid; ?>','<?php echo $this->encrypt->sha1($color->color_uid); ?>')"></a></td>
								</tr>
						<?php } } ?>
					</table>
					<div id="paginacion"><?php echo $paginacion; ?></div>
				</span>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>