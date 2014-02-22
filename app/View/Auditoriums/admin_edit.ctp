
<h1>Editar Sala</h1>
<?php
echo $this->Form->create(
		'Auditorium', array('inputDefaults' => array('div' => 'field-input'),
	'type' => 'file'));

echo $this->Form->inputs(
		array(
			'legend' => '',
			'nombre',
			'direccion' => array('label' => 'Dirección'),
			'telefono' => array('label' => 'Teléfono'),
			'horario',
			'url_mapa' => array('label' => 'URL del Mapa', 'rows' => 1),
			'costo_general',
			'costo_especial',
			'id' => array(
				'type' => 'hidden'
	)));
// No logro hacer que este código funcione como quisiera.
//echo $this->Form->inptut('zone',
//		array(
//			'label' => '¿Pertenece a alguna otra sala?',
//			'empty' => 'No, no pertenece a ninguna sala.'
//		));
?>
<div class="field-inptut">
	<label for="AuditoriumZone"> ¿Pertenece a alguna otra sala?</label>
	<select name="data[Auditorium][zone]" id="AuditoriumZone" >
		<option value="">No, no pertenece a ninguan sala.</option>
		<?php foreach ($zones as $key => $zone): ?>

			<?php if ($this->request->data['Auditorium']['id'] == $key): ?>
				<option value="<?php echo $key ?>" selected> <?php echo $zone ?> </option>
			<?php else: ?>
				<option value="<?php echo $key ?>"> <?php echo $zone ?> </option>
			<?php endif ?>

		<?php endforeach ?>
	</select>
</div>

<?php

echo $this->element('form-to-upload-image', array( 'model' => 'Auditorium'));

echo $this->Form->end("Actualizar");
