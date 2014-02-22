<?php
$this->Html->addCrumb('Salas', '/auditoriums');
$this->Html->script(
		array(
	'libs/fancybox/jquery.fancybox.js',
	'my_plugins/billboardWithFilters',
	'my_plugins/hideshowSubmenus',
	'Auditoriums'), array('inline' => false));
$this->Html->css(
		array('../js/libs/fancybox/jquery.fancybox.css')
		, array('inline' => false));
?> 
<div>Resultados: <span id="results">Todos</span></div>
<div>Filtros: <span class="applied-filters" id="applied-filters"> </span></div>
<div class="filters-menu" id="filters-menu">
    <ul>
		<?php foreach ($menu as $entry): ?>
			<li>
				<a data-filter="<?php echo $entry['classFilter'] ?>">
					<?php echo $entry['nombre'] ?>
				</a>
				<?php if (!empty($entry['subAuditorium'])): ?> 
					<ul>
						<?php foreach ($entry['subAuditorium'] as $sub): ?>
							<li>
								<a data-filter="<?php echo $sub['classFilter'] ?>">
									<?php echo $sub['nombre'] ?>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				<?php endif ?>
			</li>
		<?php endforeach ?>
    </ul>
</div>
<div class="wrapper-items" id="wrapper-items">
    <div class="without-results" id="without-results">No se encontraron salas con
        los filtros solicitados</div>
    <ul class="items" id="items">
		<?php foreach ($auditoriums as $auditorium): ?>
			<li class="item <?php echo $auditorium['classFilter'] ?>">
				<?php if (file_exists($auditorium['imageUrl'])): ?>
					<?php echo $this->Html->image($auditorium['imageUrl']); ?>
				<?php else: ?>
					<?php echo $this->Html->image('no-photo.jpg'); ?>
				<?php endif ?>
				<?php
				$url = Router::url(array(
							'controller' => 'auditoriums',
							'action' => 'detail',
							$auditorium['id']));
				?>
				<a class="slayer" href="<?php echo $url ?>">
					<h2 class="title"><?php echo $auditorium['nombre'] ?></h2>
				</a>
			</li>
		<?php endforeach ?>
    </ul>
</div>