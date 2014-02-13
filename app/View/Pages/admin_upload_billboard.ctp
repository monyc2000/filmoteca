<?php $this->Html->css('admin.css',null,array('inline'=>false));?>

<h2>Subir cartelera</h2>
<h3> <?php echo $subtitle ?></h3>

<?php
echo $this->Form->create(false,array('type' => 'file'));
echo $this->Form->input('cartelera', array(
	'type' => 'file',
	'label' => 'Subir cartelera del mes actual.',
	'name' => 'data[cartelera]'
));

echo $this->Form->end(array('label'=> 'Subir cartelera','class'=> 'submit-button'));
?>

<h3>Carteleras del año</h3>
<table class="admin">
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
</table>

