<?php $this->extend('/Commons/admin_index');?>
<?php $this->assign('subtitle','Administración de Artículos');?>
<?php $this->start('table')?>
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
<?php $this->end()?>
