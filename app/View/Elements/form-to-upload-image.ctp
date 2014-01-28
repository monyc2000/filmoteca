<?php

echo $this->Form->input($model . '.thumbnail_image', array(
	'type' => 'file',
	'div' => 'file-upload',
	'label' => 'Imagen en Miniatura'));

if ($this->action === 'edit') {
	echo $this->Html->image(strtolower($model) . 's/thumbnail_' . $this->request->data[$model]['id'] .'.jpg'
			, array(
		'width' => '200',
		'height' => '250'));
}

echo $this->Form->input($model . '.full_image', array(
	'type' => 'file',
	'div' => 'file-upload',
	'label' => 'Imagen en Normal'));

if ($this->action === 'edit') {
	echo $this->Html->image(strtolower($model) . 's/full_' . $this->request->data[$model]['id'] . '.jpg'
			, array(
		'width' => '200',
		'height' => '250'));
}
