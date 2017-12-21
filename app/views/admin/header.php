<!doctype html>
<html lang="es-mx">
<head>
	<meta charset="UTF-8">
	<meta content="Eric Bravo para Estrategas Digitales" name="author">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Administrador - Iniciativa Textil</title>
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/favicon-152.png">
	<meta name="msapplication-TileColor" content="#FFFFFF">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>img/favicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="f<?php echo base_url(); ?>img/avicon-152.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="f<?php echo base_url(); ?>img/avicon-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo base_url(); ?>img/favicon-120.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>img/favicon-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>img/favicon-72.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/favicon-57.png">
	<link rel="icon" href="<?php echo base_url(); ?>img/favicon-32.png" sizes="32x32">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<?php echo link_tag('css/manager.css'); ?>
	<?php echo link_tag('css/jquery-ui-1.10.3.min.css'); ?>
	<?php echo link_tag('css/colorpicker.css'); ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.form.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/colorpicker.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/eye.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/utils.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/spin.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/manager.js" type="text/javascript"></script>
</head>
<body>
	<div id="messages" style="display:none"></div>
	<div id="foo"></div>
	<div id="wrapp">
		<div id="header">
			<span id="logo">
				<a href="<?php echo base_url(); ?>admin">
					<img border="0" src="<?php echo base_url(); ?>img/logo.png">
				</a>
			</span>
			<span id="header_tools">
				<?php if($this->session->userdata('session') != TRUE){ ?>
					<h2>Área de administración / Iniciar sesión</h2>
				<?php }else{ ?>
					<h3>Área de administración</h3>
					<?php echo $menu; ?>
			<?php } ?>
			</span>
		</div>
		<div id="subwrapp">
			<div id="breadcrumb">
				<?php $this->load->view('admin/inc/bread'); ?>
			</div>