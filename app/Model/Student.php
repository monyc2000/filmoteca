<?php

class Student extends AppModel{
	public $name = 'Student';
	public $hasMany = 'CourseStudent';
}