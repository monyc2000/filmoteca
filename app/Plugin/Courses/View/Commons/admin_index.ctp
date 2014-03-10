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
			<?php echo $this->Html->link('Editar', array( 'action' => 'edit', $datum[$model]['id'])) ?>
			<br>
			<?php
			echo $this->Html->link('Borrar', array(
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
			Cursos
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li>
				<?php
				echo $this->Html->link(
						'Agregar Detalles de Curso', '/admin/courses/course_details/add');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Detalles de Curso', '/admin/courses/course_details/index');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Agregar Profesor', '/admin/courses/professors/add');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Profesores', '/admin/courses/professors/index');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Agregar Curso', '/admin/courses/courses/add');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Cursos', '/admin/courses/courses/index');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Agregar Sede', '/admin/courses/venues/add');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Sedes', '/admin/courses/venues/index');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Estudiantes', '/admin/courses/students/index');
				?>
			</li>
			<li>
				<?php
				echo $this->Html->link(
						'Ver Estudiantes en Cursos', '/admin/course_student/index');
				?>
			</li>
		</ul>
	</div>

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