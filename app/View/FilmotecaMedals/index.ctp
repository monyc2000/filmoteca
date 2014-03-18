<?php
$js = array(
	'libs/fancybox/jquery.fancybox',
	'my_plugins/filtersMenu',
	'FilmotecaMedal');
$css = array(
	'../js/libs/fancybox/jquery.fancybox.css');

$this->Html->script($js, array('inline'=>false));
$this->Html->css($css,null, array('inline' => false));
?>

<div>Resultados: <span id="results">Todos</span></div>
<div>Filtros: <span class="applied-filters" id="applied-filters"> </span></div>
<div class="filters-menu" id="filters-menu">
	<ul class="shop-menu">
		<?php foreach($years as $year):?>
			<li>
				<?php echo $this->Html->link(
					$year,
					array(),
					array('data-filter' => $year));?>
			</li>
		<?php endforeach?>
	</ul>
</div>

<div class="wrapper-items" id="wrapper-items">
	<div class="without-results" id="without-results">No se encontraron artículos con
		los filtros solicitados</div>
	<ul class="items" id="items">
		<?php foreach($peoples as $person):?>
			<?php $p = $person['FilmotecaMedal']?>
			<li class="item <?php echo date('Y', strtotime($p['fecha']))?>">
				<?php echo $this->Html->image($p['foto'], array('alt' => $p['nombre']))?>
				<?php
					echo $this->Html->link(
						'Detalles',
						array('action' => 'detail', $p['id']),
						array('class' => 'slayer fancybox.ajax'));
				?>
			</li>
		<?php endforeach ?>
	</ul>
</div>