<?php

class Professor extends AppModel{
	public $name = 'Professor';
	public $hasMany = array('Course' => array(
		'foreignKey' => 'profesor_id'
	));
}