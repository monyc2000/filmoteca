<?php
echo $this->Html->link(
	'Ver detalles', 
	array(
		'action' => 'detail',
		$datum['id']),
	array('title' => 'Ver detalles'));