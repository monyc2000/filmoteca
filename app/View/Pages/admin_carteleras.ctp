<?php $this->extend('/Commons/admin_index'); ?>
<?php $this->assign('subtitle', 'Carteleras del año' . date('Y')) ?>
<?php $this->start('table') ?>
<tr>
	<th>Nombre</th>
</tr>
<tr>
	<?php foreach ($files as $file): ?>
		<td>
			<?php
			echo $this->Html->link(ucfirst(str_replace('_', ' ', $file))
					, '/files/carteleras/' . date('Y') . '/' . $file)
			?>
		</td>
	<?php endforeach ?>
</tr>
<?php $this->end(); ?>