<?php
$this->Html->addCrumb('Programación','exhibitions/index');
$this->Html->css(
		array('../js/libs/fancybox/jquery.fancybox.css')
		, array('inline' => false));
$this->Html->script(array('libs/fancybox/jquery.fancybox',
	'my_plugins/billboardWithFilters',
	'my_plugins/hideshowSubmenus',
	'Exhibitions.js'
		), array('inline' => false));
?>
<div>Resultados: <span id="results">Todos</span></div>
<div>Filtros: <span class="applied-filters" id="applied-filters"> </span></div>
<div class="filters-menu" id="filters-menu">
	<ul>
		<?php foreach ($menu as $key => $val): ?>
			<li><span><?php echo $key ?></span>
				<ul>
					<?php foreach ($val as $v): ?>
						<?php $filter = strtolower(str_replace(' ', '_', $v)); ?>
						<li><a data-filter="<?php echo $filter ?>"><?php echo $v ?></a></li>
					<?php endforeach ?>
				</ul>
			</li>
		<?php endforeach ?>
	</ul>
</div>

<div class="wrapper-items" id="wrapper-items">
	<div class="without-results" id="without-results">No se encontraron películas con
		los filtros solicitados</div>
	<ul class="items" id="items">
		<?php foreach ($films as $v): ?>
			<li class="item <?php echo $v['classes'] ?>">
				<?php if (file_exists('/img/' . 'films/thumbnail_' . $v['film_id'] . '.jpg')):?>
					<?php echo $this->Html->image('films/thumbnail_' . $v['film_id'] . '.jpg') ?>
				<?php else:?>
					<?php echo $this->Html->image('no-photo.jpg') ?>
				<?php endif?>
				<a class="slayer" href="<?php echo Router::url(array('controller' => 'exhibitions', 'action' => 'detail', $v['exhibition_id'])) ?>">
					<h2 class="title"><?php echo $v['film_titulo'] ?></h2>
				</a>
			</li>
		<?php endforeach ?>
	</ul>
</div>