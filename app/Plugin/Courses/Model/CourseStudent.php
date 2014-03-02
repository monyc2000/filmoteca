<?php

class CourseStudent extends CoursesAppModel{
	public $name = 'CourseStudent';
	public $hasOne = array('Course','Student');
}