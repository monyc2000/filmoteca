<?php

class Venue extends AppModel{
	public $name = 'Venue';
	public $hasMany = 'Course';
}