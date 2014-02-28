<?php

class Venue extends AppModel{
	public $name = 'Venue';
	public $hasMany = array('Course' => array(
		'foreignKey' => 'nombre_del_curso_id'
	));
}