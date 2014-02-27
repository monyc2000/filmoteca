<?php

class Course extends AppModel{
	public $name = 'Course';
	public $hasOne = array(
		'CourseName',
		'Professor',
		'Venue');
	public $hasMany = 'CourseStudent';
}