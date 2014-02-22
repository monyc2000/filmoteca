<?php $this->extend('/Commons/admin_index'); ?>
<?php $this->assign('subtitle','Administración de Salas')?>
<?php $this->start('table'); ?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val) ?></th>
	<?php endforeach; ?>
	<th>SubSalas</th>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<?php foreach ($datum[$model] as $value): ?>
			<td><?php echo $value ?></td>
		<?php endforeach; ?>
		<td>
			<ul class="list-group">
				<?php foreach ($datum['SubAuditorium'] as $value): ?>
					<li class="list-group-item"><?php echo $value['nombre'] ?></li>
				<?php endforeach ?>
			</ul>
		</td>
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

<?php
$this->end()?>