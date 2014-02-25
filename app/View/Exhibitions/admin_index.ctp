<?php
$this->extend('/Commons/admin_index');
$this->assign('subtitle', 'Administración de la Programación');
$this->start('table');
?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<td>
			<?php echo $datum['Exhibition']['id'] ?>
		</td>
		<td> 
			<?php echo $datum['Film']['título'] ?>
		</td>
		<td>
			<?php echo $datum['Auditorium']['nombre'] ?>
		</td>
		<td class="admin-cell-thumbnail">
			<?php
			echo $this->Html->image(
					'films/thumbnail_' . $datum['Exhibition']['film_id'])
			?>
		</td>
		<td>
			<?php foreach ($datum['Timetable'] as $val): ?>
				<div class="admin-a-timetable">
					<span class="date"><?php echo $val['fecha'] ?></span><br>
					<span class="time"><?php echo $val['hora'] ?></span>
				</div>
			<?php endforeach; ?>
		</td>
		<td>
			<?php
			echo $this->Html->link(
					'Detalles'
					, array(
				'controller' => strtolower($model) . 's',
				'action' => 'detail', $datum[$model]['id'],
				'admin' => false))
			?>
			<?php
//			echo $this->Html->link('Editar', array('controller' => strtolower($model) . 's', 'action' => 'edit', $datum[$model]['id'])) 
			?>
			<br>
			<?php
//			echo $this->Html->link('Borrar', array(
//				'controller' => strtolower($model) . 's',
//				'action' => 'delete',
//				$datum[$model]['id']), array('title' => 'Borra el objeto de la base de datos.'), 'La exhibicion sera borrado completamente de la base de datos. ¿Borrarlo?');
			?>
			<br>
			<?php echo $this->fetch('others_actions'); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php
$this->end();
