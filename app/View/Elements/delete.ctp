<?php
echo $this->Html->link(
	'Borrar', 
	array(
		'action' => 'delete',
		$datum['id']),
	array('title' => 'Borra el objeto de la base de datos.'), 
	'El registro sera borrado completamente de la base de datos. ¿Borrarlo?');