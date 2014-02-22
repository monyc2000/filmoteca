<h2>Prensa</h2>
<p>Se encarga de establecer contacto con los medios de comunicación, a través de boletines e invitaciones que se envían por correo electrónico, para mantenerlos informados de las diversas actividades que realiza la Dirección General de Actividades Cinematográficas: programación, actividades especiales, rescates, hallazgos  conferencias de prensa y lo relacionado con nuestro. </p>
<p>¿Desea recibir información del Área de prensa?</p>
<?php
$formOptions = array(
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);
$fields['legend'] = false;
echo $this->Form->create('PressRegister', $formOptions);
?>

<fieldset>
	<div class="field-input">
		<label for="tipo_de_medios">
			Tipo de Medio
		</label>
		<select name="data[PressRegister][tipo_de_medio]">
			<?php foreach ($tipos_de_medios as $val): ?>

				<option value="<?php echo $val['tipos_de_medios']['id'] ?>">
					<?php echo $val['tipos_de_medios']['nombre'] ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>
</fieldset>
<?php
echo $this->Form->inputs($fields, $blackList);
echo $this->Form->submit('Enviar datos',array('class'=> 'btn btn-default'));
echo $this->Form->end();