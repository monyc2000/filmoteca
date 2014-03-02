<?php $this->Html->css('admin', null, array('inline' => false)) ?>

<?php $this->startIfEmpty('table') ?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<?php foreach ($datum[$model] as $value): ?>
			<td><?php echo $value ?></td>
		<?php endforeach; ?>
		<td>
			<?php echo $this->Html->link('Editar', array('controller' => strtolower($model) . 's', 'action' => 'edit', $datum[$model]['id'])) ?>
			<br>
			<?php
			echo $this->Html->link('Borrar', array(
				'controller' => $model . 's',
				'action' => 'delete',
				$datum[$model]['id']), array('title' => 'Borra el objeto de la base de datos.'), 'El registro sera borrado completamente de la base de datos. ¿Borrarlo?');
			?>
			<br>
			<?php echo $this->fetch('others_actions'); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php $this->end(); ?>

<?php
$numbersOptions = array(
	'tag' => 'li',
	'separator' => '',
	'currentClass' => 'active',
	'currentTag' => 'a');
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
						'Agregar cartelera', '/admin/pages/upload_billboard');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver carteleras', '/admin/pages/carteleras');
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

<h2><?php echo $this->fetch('subtitle') ?></h2>
<?php echo $this->fetch('head'); ?>

<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, array('escape' => false, 'tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled prev')); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled next')); ?>
</ul>
<table class="admin-index">
	<?php echo $this->fetch('table') ?>
</table>
<ul class='pagination'>
	<?php echo $this->Paginator->prev('<< Anterior', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled prev')); ?>
	<?php echo $this->Paginator->numbers($numbersOptions); ?>
	<?php echo $this->Paginator->next('Siguiente >>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled next')); ?>
</ul>