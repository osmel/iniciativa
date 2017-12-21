<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
	<table align="center" border="0" bgcolor="#fdfcf8" cellpadding="0" cellspacing="0" width="600" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;color:#3f3d3c">
    	<tr>
        	<td style="text-align:center;padding:20px 0;"><img border="0" src="<?php echo base_url(); ?>img/logo.png" widht="40%" /></td>
        </tr>
        <tr>
        	<td>
            	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="background:url(<?php echo base_url(); ?>img/liston_costuras.jpg) repeat-x;font-size:12px;" height="60px">
                	<tr>
                    	<td style="padding:10px 40px 0 40px"><strong><?php echo $nombre.' '.$apellidos; ?></strong></td>
                    </tr>
                    <tr>
                    	<td style="color:#ffffff; padding:0 40px 10px 40px;">Ha solicitado algunos de los catálogos físicos.  Su número de pedido es: <strong><?php echo $folio_catalogo; ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td style="padding:20px 40px;">Estos fueron los catálogos que solicitó</td>
        </tr>
        <tr>
        	<td>
            	<table align="center" border="0" cellpadding="0" cellspacing="0" width="88%" style="font-size:10px">
                    <tr>
                    	<td style="border:1px solid #008fc5;text-align:left; padding:10px 5px;">
                            <?php foreach(json_decode($catalogos) as $catalogo){ ?>
                                <span style="display:inline-block;vertical-align:top;width:230px;"><?php echo $catalogo; ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td style="padding:10px 40px 5px 40px;">Los datos de contacto que proporcionó son:</td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">E-mail: <strong><?php echo $email; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Teléfono: <strong><?php echo $telefono; ?></strong></td>
        </tr>
        <tr>
        	<td style="padding:5px 40px;">Dirección: <strong><?php echo $direccion; ?></strong></td>
        </tr>
    </table>
</body>
</html>