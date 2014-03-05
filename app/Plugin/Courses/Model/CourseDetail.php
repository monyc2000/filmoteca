<?php

class CourseDetail extends CoursesAppModel{
	public $name = 'CourseDetail';
	public $belongsTo = array('Course','Professor','Venue');
	public $hasMany = 'CourseStudent';
	
	public function getInputFields(array $data = array() ){
		$fields = array();
		$preFields = array_keys($this->schema());
		
		foreach($preFields as $value){
			switch($value){
				case('course_id'):
					$fields['course_id'] = array(
						'label' => 'Curso',
						'selected' => $data['Course']['id']
					);
				case('professor_id'):
					$fields['professor_id'] = array(
						'label' => 'Profesor',
						'selected' => $data['Professor']['id']
					);
					break;
				case('venue_id'):
					$fields['venue_id'] = array(
						'label' => 'Sede',
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