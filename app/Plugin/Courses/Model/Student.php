<?php

class Student extends CoursesAppModel{
	public $name = 'Student';
	public $hasMany = 'CourseStudent';
}