<?php

class Auditorium extends AppModel{
	public $name = 'Auditoriums';
	public $displayField = 'nombre';
	
	public $hasMany = array(
		'SubAuditorium' => array(
			'className' => 'Auditorium',
			'foreignKey' => 'zone'
		),
		'Exhibition'
	);

}
