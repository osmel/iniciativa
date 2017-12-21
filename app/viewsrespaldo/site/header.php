<!doctype html>
<html lang="es-mx">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Telas,Textiles,Venta,Algodón,Mayoreo,México">
	<meta name="description" content="Venta de Telas, Mayoreo y menudeo en México a excelentes precios.">
	<meta content="Estrategas Digitales" name="author">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<title>Iniciativa Textil</title>
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/favicon-152.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>img/favicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="f<?php echo base_url(); ?>img/favicon-152.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="f<?php echo base_url(); ?>img/favicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo base_url(); ?>img/favicon-120.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>img/favicon-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>img/favicon-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/favicon-57.png">
	<link rel="icon" href="<?php echo base_url(); ?>img/favicon-32.png" sizes="32x32">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<?php echo link_tag('css/jquery-ui.min.css'); ?>
	<?php echo link_tag('css/colorbox.css'); ?>
	<?php echo link_tag('css/site.css'); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.colorbox-es.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.form.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.touchSwipe.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.carouFredSel-6.2.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/spin.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.imageLens.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/site.js" type="text/javascript"></script>
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46223073-1', 'iniciativatextil.com');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');

    </script>
</head>
<body>
	<div id="foo"></div>
	<div id="messages" style="display:none"></div>
	<div id="wrapp">
		<div id="header">
			<span id="logo">
				<a href="<?php echo base_url(); ?>home">
					<img border="0" src="<?php echo base_url(); ?>img/logo.png">
				</a>
			</span>
			<span id="header_tools">
				<span id="content_tools">
					<span class="promociones">
						Entérate de nuestras <span class="blue-sky">promociones</span>
						<span class="flecha-promo"></span>
						<?php $this->load->view('site/inc/newsletter-tool'); ?>
					</span>
					<span class="bloque-segundo-header">
						<span class="social-fb-header">
							<a href="https://www.facebook.com/IniciativaTex?fref=ts" target="_blank">
								<span class="sprite facebook-header"></span>
							</a>
						</span>
						<span id="box-input-carrito">
							<span class="carrito"></span>
							<span id="totales">
								<span id="inputcarrito"><strong><?php echo $this->cart->total_items(); ?></strong> PROD.</span>
								<a href="<?php echo base_url(); ?>ver-carrito">Ver carrito</a>
							</span>
						</span>
					</span>
				</span>
				<span id="menusup">
					<?php echo $menu; ?>
				</span>
			</span>
		</div>
		<div id="subwrapp">
			<div id="breadcrumb">
				<?php echo set_breadcrumb(); ?>
			</div>