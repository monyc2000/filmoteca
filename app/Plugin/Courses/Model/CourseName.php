<?php

class CourseName extends CoursesAppModel{
	public $name = 'CourseName';
	public $hasMany = array('Course' => array(
		'foreignKey' => 'nombre_del_curso_id'
	));
}
