<?php

class SpecialExhibition extends AppModel {

	public $name = 'SpecialExhibition';
	public $displayField = 'nombre';
	public $hasMany = "Exhibitions";

}
