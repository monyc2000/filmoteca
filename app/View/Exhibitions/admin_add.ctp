<h2>Agregar Exhibición</h2>
<?php
$this->Html->script('ExhibitionsAdd', array('inline' => false));
$this->Html->script('hideFlash', array('inline' => false));

$formOptions = array(
	'action' => 'add',
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);
echo $this->Form->create('Exhibition', $formOptions);
echo $this->Form->input('Exhibition.film_id', array('type' => 'text', 
	'label'=> 'Nombre de Pelicula',
	'data-json' => Router::url(array('controller'=>'films','action'=>'list_films'))));
echo $this->Form->input('Exhibition.special_exhibition_id',array('label'=> 'Tipo de Exhibición'));
echo $this->Form->input('Película', array(
	'type' => 'hidden',
	'name' => 'data[Exhibition][film_id]',
	'value' => -1,
	'id' => 'film_id'));
//echo $this->Form->input('Exhibition.auditorium_id'); // no funciona ¿porqué?
echo $this->Form->input('Sala', array('options' => $auditoriums, 'name' => 'data[Exhibition][auditorium_id]'));
?>
<h3>Horarios</h3>
<?php
echo $this->Form->input('Timetable.0.fecha');
echo $this->Form->input('Timetable.0.hora');
echo $this->Html->link('Agregar otro horario.', '#', array('id' => 'add-new-timetable'));
echo $this->Form->submit('Agregar',array('class'=> 'btn btn-default'));
?>

<?php echo $this->Form->end(); ?>