<?php

class Professor extends CoursesAppModel{
	public $name = 'Professor';
	public $hasMany = array('Course' => array(
		'foreignKey' => 'profesor_id'
	));
}