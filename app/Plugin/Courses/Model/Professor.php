<?php

class Professor extends CoursesAppModel{
	public $name = 'Professor';
	public $hasMany = 'CourseDetail';
}