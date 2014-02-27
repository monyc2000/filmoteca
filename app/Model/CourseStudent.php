<?php

class CourseStudent extends AppModel{
	public $name = 'CourseStudent';
	public $hasOne = array('Course','Student');
}