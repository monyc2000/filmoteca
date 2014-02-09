<?php
$this->Html->script('libs/jquery.validate.min', array('inline' => false));
$this->Html->script('FilmsAdd', array('inline' => false));
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
<h2>Editar Película</h2>
<?php
echo $this->Form->create('Film', $formOptions);
echo $this->Form->inputs($filmFields, $filmBlackList);
echo $this->element('form-to-upload-image', array('model'=>'Film','edit'=> true));
echo $this->Form->end('Actualizar');
?>