<?php

class Souvenir extends AppModel {

	public $name = 'Souvenir';
	public $belongsTo = 'Item';

	public function getFieldInputs() {
		$fields = array('legend' => false);
		$titles = array_keys($this->schema());
		foreach ($titles as $val) {
			array_push($fields, $this->name . '.' . $val);		
			
		}

		return $fields;
	}

}
