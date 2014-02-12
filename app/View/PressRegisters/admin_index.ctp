<?php $this->extend('/Commons/admin_index'); ?>

<?php $this->start('head') ?>
<h2>Administracion de Prensa</h2>
<div class="controls">
	<?php
	echo $this->Form->create(false);

	echo $this->Form->input('day', array(
		'label' => 'Día: ',
		'dateFormat' => 'D',
		'type' => 'date',
		'empty' => __('Cualquiera'),
		'selected' => _('Cualquiera'),
		'name' => 'day'
	));

	echo $this->Form->input('month', array(
		'label' => 'Mes: ',
		'dateFormat' => 'M',
		'type' => 'date',
		'empty' => __('Cualquiera'),
		'selected' => _('Cualquiera'),
		'name' => 'month'
	));

	echo $this->Form->input('year', array(
		'label' => 'Año: ',
		'dateFormat' => 'Y',
		'minYear' => 2013,
		'maxYear' => 2014,
		'type' => 'date',
		'name' => 'year',
		'selected' =>  '2014-01-01 00:00:00',
	));
	echo $this->Form->end(array('label'=> 'Buscar','class' => 'submit-button'));
	?>
</div>
<?php $this->end(); ?>

<?php $this->start('table') ?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<?php $datum['PressRegister']['tipo_de_medio'] = $datum['TipoDeMedio']['nombre'] ?>
		<?php foreach ($datum[$model] as $value): ?>
			<td><?php echo $value ?></td>
		<?php endforeach; ?>
		<td>
			<?php echo $this->Html->link('Borrar', array('controller' => $model . 's', 'action' => 'delete', $datum[$model]['id'])) ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php
$this->end()?>