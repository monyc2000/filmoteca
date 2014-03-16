<?php 
$this->Html->css('admin', null, array('inline' => false));
$this->Html->script('hideFlash', array('inline' => false));

$numbersOptions = array(
	'tag' => 'li',
	'separator' => '',
	'currentClass' => 'active',
	'currentTag' => 'a');

$prevOptions = array(
	'escape' => false, 
	'tag' => 'li', 
	'disabledTag' => 'a', 
	'class' => 'disabled prev');

$nextOptions = array(
	'tag' => 'li', 
	'disabledTag' => 'a', 
	'class' => 'disabled next');


?>

<?php
$this->start('action');
	foreach($model->actions as $action ){
		echo $this->element($action);
	}
$this->end();
?>

<!-- Adminitrator menu -->
<div class="btn-group">
	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Programación
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php
				echo $this->Html->link(
						'Ver todas la programación.'
						, '/admin/exhibitions')
				?>
			</li>
			<li><?php
				echo $this->Html->link(
						'Agregar una nueva programación.'
						, '/admin/exhibitions/add')
				?>
			</li>
		</ul>
	</div>

	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Artículos
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php
				echo $this->Html->link(
						'Ver todos los libros.'
						, '/admin/items/index/Book')
				?>
			</li>
			<li><?php
				echo $this->Html->link(
						'Ver todas las películas.'
						, '/admin/items/index/Film')
				?>
			</li>
			<li><?php
				echo $this->Html->link(
						'Ver todos los artículos promocionales.'
						, '/admin/items/index/Souvenir')
				?>
			</li>
			<li><?php
				echo $this->Html->link(
						'Agregar un nuevo artículo.'
						, '/admin/items/add')
				?>
			</li>
		</ul>
	</div>

	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Eventos
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php
				echo $this->Html->link(
						'Ver todas los eventos.'
						, '/admin/events')
				?>
			</li>
			<li><?php
				echo $this->Html->link(
						'Agregar un nuevo evento.'
						, '/admin/events/add')
				?>
			</li>
		</ul>
	</div>

	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Prensa
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php
				echo $this->Html->link(
						'Ver todos los registros.'
						, '/admin/press_registers')
				?></li>
			<li class="disabled"><?php
				echo $this->Html->link(
						'Agregar nuevo tipo de medio.'
						, '/admin/press_registers/add_new_medio_type')
				?>
			</li>
		</ul>
	</div>

	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Salas
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li><?php
				echo $this->Html->link(
						'Ver todas la salas.'
						, '/admin/auditoriums')
				?></li>
			<li><?php
				echo $this->Html->link(
						'Agregar una nueva sala.'
						, '/admin/auditoriums/add')
				?></li>
		</ul>
	</div>

	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			Cartelera
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li>
				<?php
				echo $this->Html->link(
						'Agregar cartelera', '/admin/billboards/add');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver carteleras', '/admin/billboards/index');
				?>
			</li>
		</ul>
	</div>

	<?php
	echo $this->Html->link(
			'Administrar Cursos'
			, array('plugin'=>'courses','controller' => 'courses')
			,array(
				'class' => 'btn btn-default'));
	?>

</div>
<br>

<h2><?php echo $subtitle?></h2>

<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, $prevOptions); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, $nextOptions); ?>
</ul>

<table class="admin-index">
	<tr>
		<?php foreach ($model->titles as $column_name => $title): ?>
			<th><?php echo $this->Paginator->sort($column_name, $title) ?></th>
		<?php endforeach; ?>
		<th>Acciones</th>
	</tr>
	<?php foreach ($data as $datum): ?>
		<tr>
			<?php foreach ($datum[$modelName] as $value): ?>
				<td><?php echo $value ?></td>
			<?php endforeach; ?>
			<td>
				<?php foreach($model->actions as $action):?>
					<?php echo $this->element($action, array('datum' => $datum[$modelName]))?>
				<?php endforeach;?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>

<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, $prevOptions); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, $nextOptions); ?>
</ul>