<?php
$this->Html->script(
		array(
	'libs/fancybox/jquery.fancybox',
	'my_plugins/billboardWithFilters',
	'my_plugins/hideshowSubmenus',
	'Shop'), array('inline' => false));
$this->Html->css(
		array('../js/libs/fancybox/jquery.fancybox.css')
		, array('inline' => false));
?>
<?php $this->start('shopping-cart'); ?>
<div class="wrapper-cart">
	<div id="cart" data-href="/filmotecaH/js/cart.json">
		<div class="shopping">
			<div class="shopping-list">
				<?php
				$total = 0;
				$subtotal = 0;
				$cart = $this->Session->read('cart');
				?>
				<table>
					<?php foreach ($cart as $v): ?>
						<tr>
							<td><?php echo $v['nombre'] ?></td>
							<td><?php echo $v['cantidad'] . ' x ' ?></td>
							<td><?php
								$subtotal = $v['cantidad'] * $v['precio_de_venta'];
								$total += $subtotal;
								echo $subtotal
								?></td>
						</tr>
					<?php endforeach ?>
				</table>


			</div>
			<div class="view-shopping-list">
				<?php
				echo $this->Html->link(
						'Ver lista de compras', array('controller' => 'items',
					'action' => 'showCart'))
				?>
			</div>
			<div class = "total">Total: <span><?php echo $total ?></span></div>
		</div>
	</div>
</div>
<?php $this->end() ?>
<div>Resultados: <span id="results">Todos</span></div>
<div>Filtros: <span class="applied-filters" id="applied-filters"> </span></div>
<div class="filters-menu" id="filters-menu">
	<ul class="shop-menu">
		<li><a data-filter="">Mostrar Todos</a></li>
		<li><a data-filter="category<?php echo $categories[0]['ShopCategory']['id'] ?>">
				<?php echo $categories[0]['ShopCategory']['nombre'] ?>
			</a>
		</li>
		<li><a data-filter="category<?php echo $categories[1]['ShopCategory']['id'] ?>">
				<?php echo $categories[1]['ShopCategory']['nombre'] ?>
			</a>
		</li>
		<li>
			<a data-filter="category1">Artículos Promocionales</a>
			<ul>
				<?php
				unset($categories[0]);
				unset($categories[1]);
				?>

				<?php foreach ($categories as $val): ?>
					<li>
						<a data-filter="category<?php echo $val['ShopCategory']['id'] ?>">
							<?php echo $val['ShopCategory']['nombre'] ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</li>

	</ul>
</div>

<div class="wrapper-items" id="wrapper-items">
	<div class="without-results" id="without-results">No se encontraron artículos con
		los filtros solicitados</div>
	<ul class="items" id="items">
		<?php
		echo $this->element('shop-item', array(
			'items' => $films,
			'model' => 'Film'
		));
		echo $this->element('shop-item', array(
			'items' => $books,
			'model' => 'Book'
		));

		echo $this->element('shop-item', array(
			'items' => $souvenirs,
			'model' => 'Souvenir',
			'extraClass' => 'category1',
			'fieldTitle' => 'nombre'
		));
		?>
	</ul>
</div>