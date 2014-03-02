<?php

class Venue extends CoursesAppModel{
	public $name = 'Venue';
	public $hasMany = array('Course' => array(
		'foreignKey' => 'nombre_del_curso_id'
	));
}