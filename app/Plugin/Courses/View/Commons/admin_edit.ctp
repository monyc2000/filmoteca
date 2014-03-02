<?php
$this->Html->script('hideFlash', array('inline' => false));

$formOptions = array(
	'action' => 'edit',
	'method' => 'post',
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);

?>
<h2><?php echo $this->fetch('subtitle')?></h2>
<?php
echo $this->Form->create($model, $formOptions);
echo $this->Form->inputs($fields, $fieldsBlackList);
echo $this->fetch('extra-inputs');
echo $this->Form->submit('Editar',array('class'=> 'btn btn-default'));
echo $this->Form->end();