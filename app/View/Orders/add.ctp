<?php

$this->Html->addCrumb('Tienda', '/shop/index');
$this->Html->addCrumb('Lista de Compras', '/items/showCart');

$formOptions = array(
	'controller' =>'Orders',
	'action' => 'add',
	'type' => 'post',
	'inputDefaults' => array(
		'div' => 'field-input',
	)
);
echo $this->Form->create('Order',$formOptions);
echo $this->Form->inputs(array('nombre','direccion','legend'=> false));
echo $this->Form->end('Comprar');