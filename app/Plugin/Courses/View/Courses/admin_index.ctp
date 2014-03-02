<?php
$this->extend('/Commons/admin_index');
$this->assign('subtitle', 'Administración de Cursos');

$this->start('table')
?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<td><?php echo $datum[$model]['id'] ?></td>
		<td><?php echo $datum['CourseName']['nombre'] ?></td>
		<td><?php echo $datum['Professor']['nombre'] ?></td>
		<td><?php echo $datum['Venue']['nombre'] ?></td>
		<td><?php echo $datum[$model]['horas_totales'] ?></td>
		<td><?php echo $datum[$model]['horario'] ?></td>
		<td><?php echo $datum[$model]['fecha_inicio'] ?></td>
		<td><?php echo $datum[$model]['fecha_termino'] ?></td>
		<td><?php echo $datum[$model]['precio_general'] ?></td>
		<td><?php echo $datum[$model]['precio_unam'] ?></td>
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