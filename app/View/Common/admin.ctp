<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled')); ?>
<br>
<table>
	<tr>
		<?php foreach ($titles as $key => $val): ?>
			<th><?php echo $key ?></th>
		<?php endforeach; ?>
		<th>Acciones</th>
	</tr>
	<?php foreach ($data as $datum): ?>
		<tr>
			<?php foreach ($datum[$model] as $value): ?>
				<td><?php echo $value ?></td>
			<?php endforeach; ?>
			<td>
				<?php if ( $model == 'Film' && empty( $datum[$model]['item_id'])): ?>
					<?php echo $this->Html->link('Editar', array('controller' => 'films', 'action' => 'edit', $datum[$model]['id'])) ?>
				<?php else: ?>
					<?php echo $this->Html->link('Editar', array('controller' => 'items', 'action' => 'edit', $datum[$model]['item_id'])) ?>
				<?php endif ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<br>
<?php echo $this->Paginator->prev('<< Anterior', null, null, array('class' => 'disabled')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next('Siguiente >>', null, null, array('class' => 'disabled')); ?>