<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
</head>

<body>
<table align="center" width="600" bgcolor="#fdfcf8" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana, Geneva, sans-serif; font-size:13px;">
    <tr>
    	<td style="text-align:center;padding:20px 0;" colspan="2"><img border="0" src="<?php echo base_url(); ?>img/logo.png" width="40%" /></td>
    </tr>
    <tr>
        <td colspan="2" style="background:url(<?php echo base_url(); ?>img/liston_costuras.jpg) repeat-x;font-size:12px;color:#ffffff;padding:0px 40px 0 40px" height="66px">
			<strong style="color:#000000;"><?php echo $nombre; ?></strong> desea ponerse en contacto con Iniciativa Textil.
        </td>
    </tr>
    <tr>
    	<td colspan="2" style="padding:20px 40px;">Sus datos son:</td>
    </tr>
    <tr>
        <td width="160" style="padding:10px 0px 10px 40px;"><strong>Nombre:</strong> </td>
        <td width="440" style="padding:10px;"><?php echo $nombre; ?></td>
    </tr>
    <tr>
        <td style="padding:10px 0px 10px 40px;;"><strong>Correo electr&oacute;nico:</strong> </td>
        <td style="padding:10px;"><?php echo $email; ?></td>
    </tr>
    <tr>
        <td style="padding:10px 0px 10px 40px;"><strong>Tel&eacute;fono celular:</strong> </td>
        <td style="padding:10px;"><?php echo $telefono_celular; ?></td>
    </tr>
    <tr>
        <td style="padding:10px 0px 10px 40px;"><strong>Teléfono:</strong> </td>
        <td style="padding:10px;"><?php echo $telefono; ?></td>
    </tr>
    <tr>
    	<td style="padding:10px 0px 10px 40px;" colspan="2"><strong>Mensaje:</strong> </td>
    </tr>
    <tr>
    	<td style="padding:5px 40px 20px 40px;" colspan="2"><?php echo $mensaje; ?></td>
    </tr>
</table>
	
</body>
</html>
