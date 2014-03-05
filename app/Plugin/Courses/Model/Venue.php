<?php

class Venue extends CoursesAppModel{
	public $name = 'Venue';
	public $hasMany = 'CourseDetail';
}