<?php
$this->Html->script('hideFlash', array('inline' => false));
$this->Html->addCrumb('Admin ' . __($model->name), array('action'=>'index'));

$formOptions = array(
	'action' => 'add',
	'method' => 'post',
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);

?>
<h2><?php echo $subtitle ?></h2>
<p><?php echo $model->notes ?></p>
<?php
echo $this->Form->create($model->name, $formOptions);
echo $this->Form->inputs($model->fields, $model->fieldsBlackList);
echo $this->Form->submit('Agregar',array('class'=> 'btn btn-default'));
echo $this->Form->end();