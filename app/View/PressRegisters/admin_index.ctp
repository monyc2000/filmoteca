<?php $this->extend('/Commons/admin');?>
<?php $this->start('table')?>
<tr>
	<?php foreach ($titles as $key => $val): ?>
	<th><?php echo $this->Paginator->sort($key) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<?php $datum['PressRegister']['tipo_de_medio'] = $datum['TipoDeMedio']['nombre']?>
		<?php foreach ($datum[$model] as $value): ?>
			<td><?php echo $value ?></td>
		<?php endforeach; ?>
		<td>
			<?php echo $this->Html->link('Borrar', array('controller' => $model . 's', 'action' => 'delete', $datum[$model]['id'])) ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php $this->end()?>