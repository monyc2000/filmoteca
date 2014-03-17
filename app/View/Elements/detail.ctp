<?php
echo $this->Html->link(
	'Ver detalles', 
	array(
		'admin' => false
		'action' => 'detail',
		$datum['id']),
	array('title' => 'Ver detalles'));