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
				'controller' => strtolower($model) . 's',
				'action' => 'delete',
				$datum[$model]['id']), array('title' => 'Borra el objeto de la base de datos.'), 'El artículo sera borrado completamente de la base de datos. ¿Borrarlo?');
			?>
			<br>
			<?php echo $this->fetch('others_actions'); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php $this->end(); ?>


<?php echo $this->fetch('head'); ?>
<?php $this->Html->css('admin', null, array('inline' => false)) ?>

<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled prev')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled next')); ?>
<table class="admin-index">
	<?php echo $this->fetch('table') ?>
</table>
<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled prev')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled next')); ?>