<!doctype html>
<html lang="es-mx">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="Telas,Textiles,Venta,Algodón,Mayoreo,México">
	<meta name="description" content="Venta de Telas, Mayoreo y menudeo en México a excelentes precios.">
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
	<script src="<?php echo base_url(); ?>js/jquery.elevatezoom.js" type="text/javascript"></script>
	
	<!-- Nuevos estilos enr rediseño -->	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <?php echo link_tag('css/styles.css'); ?>
    <?php echo link_tag('css/demo.css'); ?>
    <?php echo link_tag('css/yamm.css'); ?>    
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
	<!-- <div id="wrapp"> -->
		<!-- <div id="header">
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
		</div> -->

		<!-- NUEVO HEADER -->
<div class="container header">
    <div class="col-md-2 col-sm-2 sinborde">
    	<a href="<?php echo base_url(); ?>home">
      		<img class="logoheader" src="<?php echo base_url(); ?>img/nuevo/logo.png">
      	</a>
    </div>
    <div class="col-md-6 col-sm-6 quitar text-center atencion"> 
    	<div class="col-md-6 col-sm-6">
	    	<span class="titatencion">¡ATENCIÓN AL CLIENTE!</span><br>
	    	<div class="head1">
	            <i class="fa fa-phone" aria-hidden="true"></i>
	              <div class="foot_cont_info">
	                <p>55422391</p>
	                <p>55221237</p>
	              </div>
	        </div>
        </div>
        <div class="col-md-6 col-sm-6">
        	<a href="<?php echo base_url(); ?>catalogo-fisico">
      			<img class="logoheader" src="<?php echo base_url(); ?>img/boton.png">
      		</a>        	
        </div>
    </div>
    <div class="col-md-4 col-sm-4 quitar text-right">
    <span class="promociones promoarriba">
		Entérate de <span class="blue-sky">nuestras promociones</span>
		<!-- <span class="flecha-promo"></span> -->
		<?php $this->load->view('site/inc/newsletter-tool'); ?>
	</span>
    </div>
  </div>  
<div class="row headerow">
  <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button> 
      <span id="box-input-carrito" class="inputcarrit2">
		<span class="carrito"></span>
		<span id="totales">
			<span id="inputcarrito"><strong><?php echo $this->cart->total_items(); ?></strong> PROD.</span>
			<a href="<?php echo base_url(); ?>ver-carrito">Ver carrito</a>
		</span>
	</span>     
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <div class="row menu1">
        <div class="container sinborde">
          <!-- <ul class="nav navbar-nav">
          <li><a href="">Enlace 1</a></li>
          <li><a href="">Enlace 1</a></li>
          <li><a href="">Enlace 1</a></li>
          </ul>  -->
            <div class="col-md-6 sinborde">
            	<span id="menusup">
            	
            	<a href="<?php echo base_url(); ?>" class="enlacehome">INICIO</a>
					<?php echo $menu; ?>
			</span>
            </div>
            <div class="col-md-6 quitar sinborde">            	
			    <span id="box-input-carrito" class="quitar">
					<span class="carrito"></span>
					<span id="totales">
						<span id="inputcarrito"><strong><?php echo $this->cart->total_items(); ?></strong> PROD.</span>
						<a href="<?php echo base_url(); ?>ver-carrito">Ver carrito</a>
					</span>
				</span>
			</div>
            



        </div>
      </div>
      <div class="navbar yamm menu2">  
        <div class="container sinborde">
        	<div class="col-md-12">        
	          <ul class="nav navbar-nav">
	            <span class="txt_catalogo">CATÁLOGO:</span>
	            <?php $this->load->view('site/sidebar-menu'); ?>
	            <!-- <li class="dropdown yamm-fw">
	            <a href="#" data-toggle="dropdown" class="dropdown-toggle">POR TIPO DE TELA<b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li class="grid-demo">
	                  <div class="row megamen">
	                    <div class="col-xs-12 col-sm-3">
	                      <a href="#">Popelina</a>
	                      <a href="#">Bramante</a>
	                      <a href="#">Gabardina</a>
	                      <a href="#">Razo</a>
	                      <a href="#">Sarga</a>
	                    </div>
	                  </div>                   
	                </li>
	              </ul>
	            </li>   
	            <li class="dropdown yamm-fw">
	              <a href="#" data-toggle="dropdown" class="dropdown-toggle">POR COMPOSICIÓN<b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li class="grid-demo">
	                  <div class="row megamen">
	                    <div class="col-xs-12 col-sm-3">
	                      <a href="#">Popelina</a>
	                      <a href="#">Bramante</a>
	                      <a href="#">Gabardina</a>
	                      <a href="#">Razo</a>
	                      <a href="#">Sarga</a>
	                    </div>
	                  </div>                   
	                </li>
	              </ul>
	            </li> -->
	          </ul>
	          <?php $this->load->view('site/inc/search-tool'); ?>
	      	</div>	      	
          		
      		
        </div>        
      </div>
    </div>
  </nav>
</div>
<div class="container general">
	<div id="breadcrumb">
		<br>
     	<?php //echo set_breadcrumb(); ?>
 	</div>
		<!-- FIN NUEVO HEADER -->
		<!-- <div id="subwrapp">
			<div id="breadcrumb">
				<?php echo set_breadcrumb(); ?>
			</div> -->