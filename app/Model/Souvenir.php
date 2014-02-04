<?php

class Souvenir extends AppModel {

	public $name = 'Souvenir';
	public $belongsTo = 'Item';

	public function getFields() {
		$fields = array('legend' => false);
		foreach ($this->schema() as $key => $value) {
			array_push($fields, $this->name . '.' . $key);
		}

		return $fields;
	}

}
