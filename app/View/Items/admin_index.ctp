<?php $this->Html->css('admin',null, array('inline' => false)) ?>

<h2>Visualizando <?php echo $category ?></h2>
<div class="column"><?php
	echo $this->Html->link(
			'Agragar artículo', array(
		'action' => 'add'))
	?>
</div>
<div class="column">
	<h4>Visualizar:</h4>
	<ul>
		<li><?php
			echo $this->Html->link(
					'Libros', array('action' => 'index', 'Book'));
			?>
		</li>
		<li><?php
			echo $this->Html->link(
					'Películas', array('action' => 'index', 'Film'))
			?>
		</li>
		<li><?php
			echo $this->Html->link(
					'Souvenirs', array('action' => 'index', 'Souvenir'))
			?>
		</li>
	</ul>
</div>
<div style="clear:left"></div>

<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled prev')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled next')); ?>
<table class="admin-index">
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
				<?php
				echo $this->Html->link('Activar/Desactivar', array(
					'controller' => strtolower($model) . 's',
					'action' => 'on_off',
					$datum[$model]['id']), array('title' => 'Desactiva o Activa un articulo de la tienda.'))
				?>
				<br>
				<?php echo $this->Html->link('Detalles', array('admin' => false, 'controller' => strtolower($model) . 's', 'action' => 'detail', $datum[$model]['id'])) ?>
				<br>
				<?php echo $this->Html->link('Editar', array('controller' => strtolower($model) . 's', 'action' => 'edit', $datum[$model]['id'])) ?>
				<br>
				<?php
				echo $this->Html->link('Borrar', array(
					'controller' => strtolower($model) . 's',
					'action' => 'delete',
					$datum[$model]['id']), array('title' => 'Borra el objeto de la base de datos.'), 
						'El artículo sera borrado completamente de la base de datos. ¿Borrarlo?');
				?>
				<br>
				<?php echo $this->fetch('others_actions'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled prev')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled next')); ?>
