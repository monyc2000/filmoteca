<?php echo $this->Html->addCrumb('Tienda', '/shop/index');?>
<?php $cart = $this->Session->read('cart');?>
<?php $total = 0 ?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Cantidad</th>
		<th>Total</th>
	</tr>
	<?php if (!empty($cart)): ?>
		<?php foreach ($cart as $v): ?>
			<?php $subtotal = 0 ?>
			<tr><td><?php echo $v['nombre'] ?></td>
				<td><?php echo '$' . $v['precio_de_venta'] ?></td>
				<td><?php echo 'x' . $v['cantidad'] ?></td>
				<td><?php
					$subtotal = $v['cantidad'] * $v['precio_de_venta'];
					echo '$' . $subtotal
					?></td>
				<?php $total += $subtotal ?>
			</tr>
		<?php endforeach ?>
	<?php endif ?>
	<tr><td>Total</td><td colspan="3" class="total">$<?php echo $total ?></td></tr>
</table>
<?php
echo $this->Html->Link('Continuar', array('controller' => 'orders', 'action' => 'add'));
