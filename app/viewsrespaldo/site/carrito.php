<?php $this->load->view('site/header'); ?>
<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.colorbox-es.js" type="text/javascript"></script>
		<div id="content">
			<div id="view-content">
				<?php $this->load->view('site/sidebar-menu'); ?>
				<div id="contenido">
					<span class="leyenda_carrito">Número de artículos añadidos a tu carrito: <strong><?php echo $this->cart->total_items(); ?></strong></span>
					<?php $update_car = array('id'=>'update_cart_form','method'=>'post','autocomplete'=>'off'); echo form_open('actualizar_carrito', $update_car); ?>
					<table align="center" border="1" cellpadding="0" cellspacing="0" width="100%" class="carrito_producto">
						<tr>
							<th width="12%">Artículo</th>
							<th width="17%">Color</th>
							<th width="17%">Modelo</th>
							<th width="10%">Tipo de compra</th>
							<th width="10%">Metros en rollo</th>
							<th width="12%">Cantidad</th>
							<th width="20%">Precio</th>
						</tr>

						<?php 
						$precio_total_compra=0;
						$i = 1; 
						foreach($this->cart->contents() as $items): ?>
							<tr>
								<td>
									<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
									<?php if($items['options']['img_product']){ ?>
										<img border="0" src="<?php echo base_url().'uploads/'.$items['options']['img_product']; ?>">
									<?php }else{ ?>
										<img border="0" src="<?php echo base_url(); ?>img/no_image_80x80.jpg">
									<?php } ?>
									<span class="carrito_producto_nombre"><?php echo $items['name']; ?></span>
								</td>
								<td>
									<?php if(isset($items['options']['color'])){ ?>
										<span class="color_demo" style="background-color:#<?php echo $items['options']['hex_color']; ?>;"></span>
										<span class="color_nombre_detalle"><?php echo $items['options']['nombre_color']; ?></span>
									<?php }else{ echo "-"; } ?>
								</td>
								<td><?php if(isset($items['options']['modelo'])) echo $items['options']['modelo']; else echo "-"; ?></td>
								
								<td><?php echo $items['options']['tipo_venta']; ?></td>
								<td><?php 
								if($items['options']['tipo_venta'] == "Rollo" && $items['options']['metros_rollo'] != 0)
									echo $items['options']['metros_rollo']; 
								else
									echo "-";?></td>

								<td>
									<input class="carrito_art_cantidad" maxlength="3" name="<?php echo $i.'[qty]'; ?>" type="text" value="<?php echo $items['qty']; ?>" size="5">
								</td>
								<?php 
								if($items['options']['tipo_venta'] == "Rollo" && $items['options']['metros_rollo'] != 0)
								{
									$precio_total_producto = $this->cart->format_number($items['price']*$items['options']['metros_rollo']*$items['qty']);
									$precio_total_compra += ($items['price']*$items['options']['metros_rollo']*$items['qty']); 
								}
								else
								{
									$precio_total_producto = $this->cart->format_number($items['price']*$items['qty']);
									$precio_total_compra += ($items['price']*$items['qty']); 
								}
								
								?>
								
								<td><?php echo "MXN $".$precio_total_producto; ?></td>
							</tr>
						<?php $i++; endforeach; ?>
						<tr>
							<td colspan="7" style="text-align:left;">
								<span>Notas del carrito: </span></br>
								<span>1.- Para borrar un producto del carrito debes colocar un cero en la cantidad y dar clic en el botón "Actualizar Carrito".</span>
								</br>
								<span>2.- Antes de confirmar tu pedido da clic en el botón "Actualizar Carrito", para confirmar tus productos y las cantidades.</span>
							</td>
						</tr>

						<tr>
							<td colspan="7" style="text-align:right;">

								<input type="button" name="delete_cart" value="Vaciar Carrito" onclick="vaciarCarrito();">
								<?php if($this->cart->total_items() > 0) { ?>
									<input type="submit" name="update_cart" value="Actualizar Carrito" >
								<?php } ?>
							</td>
						</tr>
						<?php echo form_close(); ?>
						<tr>
							<td colspan="6">
								<input type="button" value="Confirmar pedido" name="confirmar_compra" onclick="confirmarCompra();">
							</td>
							<td>Total: <strong>$<?php echo /*$this->cart->total() . "--" .*/ $precio_total_compra; ?></strong></td>
						</tr>
					</table>
					<span class="restricciones-pedido">
						<p>(1)	Entrega sin costo en D.F. y Área Metropolitana a partir de $20,000.00.</p>
						<p>(2)	Para entregas al interior de la República Mexicana, la empresa se hace responsable de enviar la mercancía empaquetada flejada a la estación de paquetería que el que cliente indique. (No incluye los gastos de paquetería).</p>
					</span>
				</div>
			</div>
		</div>
<?php $this->load->view('site/footer'); ?>