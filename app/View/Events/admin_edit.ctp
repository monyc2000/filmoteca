<?php 

$this->Html->addCrumb('Admin Eventos', '/admin/events');
$this->Html->script('libs/jquery.validate.min', array('inline' => false));
$this->Html->script('hideFlash', array('inline' => false));
$this->Html->css('admin', null, array('inline' => false));

$formOptions = array(
	'action' => 'edit',
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);
?>
<h2>Editar Evento</h2>
<?php
echo $this->Form->create($model, $formOptions);
echo $this->Form->inputs($fields, $fieldsBlackList);
echo $this->element('form-to-upload-image', array('model'=>$model,'edit'=> true));
echo $this->Form->submit('Actualizar',array('class'=> 'btn btn-default'));
echo $this->Form->end();
?>