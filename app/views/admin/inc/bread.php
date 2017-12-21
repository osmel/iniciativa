<?php if($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'index'){ ?>
	<span>
		<a href="<?php echo base_url(); ?>admin/productos">Agregar producto</a>
	</span>
	<span>
		<form action="<?php echo base_url()."admin/index"; ?>" method="POST">
			<input type="search" name="search" id="search" placeholder="Buscar producto">
			<input type="submit" value="Buscar" name="submmit_buscar">
		</form>
	</span>
<?php } ?>