<?php $this->Html->css('admin.css',null,array('inline'=>false));?>
<?php $this->Html->script('hideFlash',array('inline'=>false));?>
<?php $this->Html->addCrumb('Admin Programación', '/admin/exhibitions')?>

<h2>Subir cartelera</h2>

<?php
echo $this->Form->create(false,array('type' => 'file'));
echo $this->Form->input('cartelera', array(
	'type' => 'file',
	'label' => 'Subir cartelera del mes actual.',
	'name' => 'data[cartelera]',
	'class'=> 'field-input'
));

echo $this->Form->submit('Agregar', array('class'=> 'btn btn-default'));
echo $this->Form->end();
?>

