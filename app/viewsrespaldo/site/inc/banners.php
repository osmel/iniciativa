<?php $banners = $this->manager->lista_banners(); 
	if($banners) { ?>
	<script src="<?php echo base_url(); ?>js/banners.js" type="text/javascript"></script>
	<div id="slideshow">
		<div id="carousel">
			<?php if($this->uri->segment(1) == 'catalogo'){ ?>
				<div><img border="0" src="<?php echo base_url(); ?>img/banner-catalogo.jpg" width="100%" /></div>
			<?php } ?>
			<?php if($banners){ ?>
				<?php foreach($banners as $banner){ ?>
					<div>
						<?php if ( $banner->link != '' ){ ?>
							<a href="<?php echo $banner->link; ?>" target="_self">
								<img border="0" src="<?php echo base_url().'uploads/banners/'.get_thumbnail($banner->img_banner, 698); ?>" alt="<?php echo $banner->nombre_banner; ?>" />
							</a>
						<?php } else { ?>
							<img border="0" src="<?php echo base_url().'uploads/banners/'.get_thumbnail($banner->img_banner, 698); ?>" alt="<?php echo $banner->nombre_banner; ?>" />
						<?php } ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>