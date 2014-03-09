<?php
$this->extend('/Commons/admin_index');

$this->start('table') ?>
<tr>
	<?php foreach ($titles as $val): ?>
		<th><?php echo $this->Paginator->sort($val['columnName'],$val['titleName']) ?></th>
	<?php endforeach; ?>
	<th>Acciones</th>
</tr>
<?php foreach ($data as $datum): ?>
	<tr>
		<?php foreach ($datum[$model] as $value): ?>
			<td><?php echo $value ?></td>
		<?php endforeach; ?>
		<td>
			<?php echo $this->Html->link('Descargar', '/' . $datum[$model]['src']) ?>
			<br>
			<?php
			echo $this->Html->link('Borrar', 
				array(
					'action' => 'delete',
					$datum[$model]['id']), 
				array('title' => 'Borra el objeto de la base de datos.'), 
				'El catálogo sera borrado completamente de la base de datos. ¿Borrarlo?');
				?>
				<br>
				<?php echo $this->fetch('others_actions'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
<?php $this->end(); ?>
