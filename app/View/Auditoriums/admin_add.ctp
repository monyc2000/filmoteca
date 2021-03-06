<?php
$this->Html->script('hideFlash', array('inline' => false));
$this->Html->addCrumb('Admin Salas', '/admin/auditoriums/');
?>
<h2>Agregar nueva Sala</h2>
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
			'costo_especial'));
echo $this->Form->input('zone', array(
	'label' => '¿Pertenece a alguna otra sala?',
	'empty' => 'No, no pertenece a ninguna sala.'
));

echo $this->element('form-to-upload-image', array('model' => 'Auditorium'));
echo $this->Form->submit('Agregar', array('class'=>'btn btn-default'));
echo $this->Form->end();
