<?php 

$this->extend('/Commons/admin_index');
$this->start('head');?>

<?php 
echo $this->Form->create(false, array('inputDefaults' => array('div' => 'input-group-adon')));

echo $this->Form->input(
	'estado_del_pago',
	array(
		'type' => 'radio',
		'legend' => false,
		'options' => array(
			0 => 'Pendientes', 
			1 => 'Pagados')));

echo $this->Form->input(
	'year',
	 array(
	 	'label'=> 'Año',
	 	'type' => 'date',
	 	'dateFormat' => 'Y',
	 	'minYear' => '2000',
	 	'maxYear' => date('Y') +1,
	 	'selected'=> date('Y') . '-01-01 00:00:00'));

echo $this->Form->submit('Consultar', array('class' => 'btn btn-default'));
echo $this->Form->end();


$this->end();

$this->start('table');?>

<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val['colName'],$val['title']) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<?php $estado_del_pago =$datum['CourseStudent']['estado_del_pago'];?>
	<tr>
		<td><?php echo $datum['Course']['nombre'] ?></td>
		<td><?php echo $datum['Student']['nombre'] ?></td>
		<td><?php echo ($estado_del_pago)? 'Pagado': 'Pendiente'; ?></td>
		<td>
			<?php if( $estado_del_pago ):?>
				<?php echo $this->Html->link(
				'Marcar como no pagado', 
				array( 
					'action' => 'checkout', 
					'nuevo_estado' => 0,
					'course_student_id' => $datum['CourseStudent']['id'])) ?>
			<?php else:?>
				<?php echo $this->Html->link(
				'Marcar como pagado', 
				array( 
					'action' => 'checkout', 
					'nuevo_estado' => 1,
					'student_id' => $datum['CourseStudent']['student_id'],
					'course_student_id' => $datum['CourseStudent']['id'])) ?>
				
			<?php endif?>
		</td>
	</tr>
<?php endforeach; ?>

<?php $this->end();