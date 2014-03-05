<?php

class CourseStudent extends CoursesAppModel{
	public $name = 'CourseStudent';
	public $belongsTo = array('CourseDetail','Student');
}