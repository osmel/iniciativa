<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
	<table align="center" border="0" bgcolor="#fdfcf8" cellpadding="0" cellspacing="0" width="600" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color:#3f3d3c">
    	<tr>
        	<td style="text-align:center;padding:20px 0;"><img border="0" src="<?php echo base_url(); ?>img/logo.png" width="40%" /></td>
        </tr>
        <tr>
        	<td>
            	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="background:url(<?php echo base_url(); ?>img/liston_costuras.jpg) repeat-x;font-size:12px;" height="60px">
                	<tr>
                    	<td style="color:#ffffff;padding:10px 40px 0 40px"><strong style="color:#000000;"><?php echo $nombre_completo; ?></strong> ha realizado un pedido.</td>
                    </tr>
                    <tr>
                    	<td style="color:#ffffff; padding:0 40px 10px 40px;">Cuyo número asignado es: <strong><?php echo $num_pedido; ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td style="padding:20px 40px;">Los productos solicitados son</td>
        </tr>
        <tr>
        	<td>
            	<table align="center" border="0" cellpadding="0" cellspacing="0" width="88%" style="font-size:10px">
                	<tr>
                    	<th style="color:#008fc5; border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;padding:5px 0 10px 0;vertical-align:top;" width="20%">Nombre del producto</th>
                        <th style="color:#008fc5; border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;padding:5px 0 10px 0;vertical-align:top;" width="15%">Color</th>
                        <th style="color:#008fc5; border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;padding:5px 0 10px 0;vertical-align:top;" width="15%">Modelo</th>
                        <th style="color:#008fc5; border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;padding:5px 0 10px 0;vertical-align:top;" width="15%">Tipo de compra</th>
                        <th style="color:#008fc5; border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;padding:5px 0 10px 0;vertical-align:top;" width="15%">Cantidad</th>
                        <th style="color:#008fc5; border-bottom:1px solid #008fc5;" width="15%">Precio</th>
                    </tr>
                    <?php foreach($this->cart->contents() as $items) { ?>
	                    <tr>
	                    	<td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><?php echo $items['name']; ?></td>
	                        <td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><?php if(isset($items['options']['nombre_color'])) echo $items['options']['nombre_color']; else echo "-"; ?></td>
	                        <td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><?php if(isset($items['options']['modelo'])) echo $items['options']['modelo']; else echo "-"; ?></td>
	                        <td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><?php echo $items['options']['tipo_venta']; ?></td>
	                        <td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><?php echo $items['qty']; ?></td>
	                        <td style="border-bottom:1px solid #008fc5;text-align:center;padding:10px 0;"><?php echo $this->cart->format_number($items['price']); ?></td>
	                    </tr>
	                <?php } ?>
                    <tr>
                    	<td style="border-right:1px solid #008fc5;border-bottom:1px solid #008fc5;text-align:left;padding:10px 5px 10px 20px;" colspan="5">Total</td>
                        <td style="border-bottom:1px solid #008fc5;text-align:center;padding:10px 5px;"><strong>$<?php echo $total_pedido; ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td style="padding:10px 40px 5px 40px;">Solicitó: <strong><?php echo $entrega_pedido; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:10px 40px 5px 40px;">Sus datos de contacto son:</td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Nombre Completo: <strong><?php echo $nombre_completo; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Correo electrónico: <strong><?php echo $correo_electronico; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Teléfono: <strong><?php echo $telefono; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Celular: <strong><?php if($telefono_celular) echo $telefono_celular; ?></strong></td>
        </tr>
        <?php if($entrega_pedido == "Envío a domicilio"){ ?>
	        <tr>
	        	<td style="padding:15px 40px 5px 40px;">Los datos para envío que proporcionó son:</td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Calle: <strong><?php echo $calle_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Número: <strong><?php echo $numero_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Colonia: <strong><?php echo $colonia_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Delegación / Municipio: <strong><?php echo $provincia_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Estado: <strong><?php echo $estado_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px;">Código Postal: <strong><?php echo $cpostal_envio; ?></strong></td>
	        </tr>
	        <tr>
	        	<td style="padding:5px 40px 20px 40px;">Teléfono: <strong><?php if(!isset($telefono_envio)) echo $telefono_envio; ?></strong></td>
	        </tr>
	    <?php } ?>
    </table>
</body>
</html>