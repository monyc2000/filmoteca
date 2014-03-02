<?php

class Course extends CoursesAppModel{
	public $name = 'Course';
	public $belongsTo = array(
		'CourseName' => array('foreignKey' =>'nombre_del_curso_id'),
		'Professor'=> array('foreignKey' =>'profesor_id'),
		'Venue'=>  array('foreignKey' =>'sede_id'));
	public $hasMany = 'CourseStudent';
	
	public function getInputFields(array $data = array() ){
		$fields = array();
		$preFields = array_keys($this->schema());
		
		foreach($preFields as $value){
			switch($value){
				case('nombre_del_curso_id'):
					$fields['nombre_del_curso_id'] = array(
						'selected' => $data['CourseName']['id']
					);
				case('profesor_id'):
					$fields['profesor_id'] = array(
						'selected' => $data['Professor']['id']
					);
					break;
				case('sede_id'):
					$fields['sede_id'] = array(
						'selected' => $data['Venue']['id']
					);
					break;
				default:
					array_push($fields, $value);
			}
		}
		
		return $fields;

	}
}