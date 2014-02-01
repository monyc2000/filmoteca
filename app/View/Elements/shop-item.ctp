<?php
if (!isset($fieldTitle)) {
	$fieldTitle = 'título';
}
if (!isset($extraClass)) {
	$extraClass = '';
}
?>
<?php foreach ($items as $item): ?>
	<li class="item category<?php echo $item['Item']['shop_category_id'] . ' ' . $extraClass; ?>">
		<div class="wrapper-item">
			<?php
			$imageUrl = strtolower($model) . 's' . DS . 'thumbnail_' . $item[$model]['id'] . '.jpg';
			$cartUrl = array(
				'controller' => 'items',
				'action' => 'addToCart',
				$item[$model]['id']
			);
			$detailUrl = array(
				'controller' => strtolower($model) . 's',
				'action' => 'detail',
				$item[$model]['id']);
			echo $this->Html->image($imageUrl, array('alt' => 'Detalles'));
			echo $this->Html->link(
					$item[$model][$fieldTitle],$detailUrl, array(
				'class' => 'fancybox.ajax slayer shop',
				'escape' => false))
			?>
			<h3><?php echo $item[$model][$fieldTitle] ?></h3>
			<p>Precio General: <?php echo $item['Item']['precio_general'] ?></p>
			<p>Precio Especial: <?php echo $item['Item']['precio_especial'] ?></p>
			<?php
			echo $this->Html->link(
					'Comprar', $cartUrl, array(
				'class' => 'buy',
				'alt' => 'comprar'
			));
			?>
		</div>
	</li>
<?php endforeach ?>