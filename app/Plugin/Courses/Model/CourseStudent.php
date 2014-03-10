<?php

class CourseStudent extends CoursesAppModel{
	public $name = 'CourseStudent';
	public $belongsTo = array('CourseDetail','Student');
	public $fields = array(
		array(
			'colName' => 'Course.name',
			'title' => 'Nombre del Curso'),
		array(
			'colName' =>'Student.name',
			'title' => 'Nombre del estudiante'),
		array(
			'colName' =>'estado_del_pago',
			'title' => 'Estado del pago'));
}