<?php $this->load->view('admin/header'); ?>
		<div id="content">
			<div id="view-content">
				<span class="sidebar-bloque">
					<?php $this->load->view('admin/nuevo-banner'); ?>
				</span>
				<span class="list-table">
					<table align="center" border="1" cellpadding="0" cellspacing="0" class="list-grid" width="500">
						<tr>
							<th width="85%">Nombre del banner</th>
							<th width="5%">Editar</th>
							<th width="5%">Activar</th>
							<th width="5%">Borrar</th>
						</tr>
						<?php if(!$banners){ ?>
							<tr>
								<td colspan="4">No existen banners para mostrar</td>
							</tr>
						<?php }else{
							foreach($banners as $banner){ ?>
							<tr>
								<td><?php echo $banner->nombre_banner; ?></td>
								<td><a href="<?php echo base_url(); ?>admin/editar_banner?buid=<?php echo $banner->buid; ?>&amp;hash=<?php echo $this->encrypt->sha1($banner->buid); ?>" class="ui-icon ui-icon-pencil"></a></td>
								<td><input type="checkbox" name="activar" value="<?php echo $banner->status_banner; ?>" <?php if($banner->status_banner != 0) echo "checked"; ?> onclick="activar_banner('<?php echo $banner->buid; ?>',<?php echo $banner->status_banner; ?>);"></td>
								<td><a href="#" class="ui-icon ui-icon-trash" onclick="borrar_banner('<?php echo $banner->buid; ?>','<?php echo $this->encrypt->sha1($banner->buid); ?>')"></a></td>
							</tr>
						<?php }
						} ?>
					</table>
					<div id="paginacion"><?php echo $paginacion; ?></div>
					<em>* Los banners se mostrarán en el sitio sólo si se encuentran activados.</em>
				</span>
			</div>
		</div>
<?php $this->load->view('admin/footer'); ?>