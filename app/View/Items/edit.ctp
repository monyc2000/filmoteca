<h2>Editar Artículo</h2>
<?php

$formOptions = array(
	'type' => 'file',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);

echo $this->Form->create('Item', $formOptions);
echo $this->Form->input('Item.precio_general');
echo $this->Form->input('Item.precio_especial');
echo $this->Form->input('Item.existencias');
?>

<div id="items">
	<div>
		<?php echo $this->Form->inputs($fields, $blackList); ?>
		<?php echo $this->element('form-to-upload-image',array('model' =>  $model))?>
	</div>
</div>
<?php
echo $this->Form->end('Editar');
?>