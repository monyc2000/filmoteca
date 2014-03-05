<?php

class Course extends CoursesAppModel{
	public $name = 'Course';
	public $hasMany = 'CourseDetail';
}
