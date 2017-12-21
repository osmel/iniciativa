<script type="text/javascript">
	//$(document).ready(function(){ $('a.gallery').colorbox({rel: 'group1'}); });
</script>
<?php foreach($imagenes as $imagen){ ?>
	<a class="gallery" href="<?php echo base_url().'uploads/galerias/'.get_image_gallery($imagen, 800); ?>">
		<img border="0" rel="group1" src="<?php echo base_url().'uploads/galerias/'.get_image_gallery($imagen, 80); ?>" />
	</a>
<?php } ?>