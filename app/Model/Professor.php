<?php

class Professor extends AppModel{
	public $name = 'Professor';
	public $hasMany = 'CourseDetail';
}