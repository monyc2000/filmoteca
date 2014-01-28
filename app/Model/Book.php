<?php

class Book extends AppModel {

	public $name = 'Book';
	public $belongsTo = 'Item';

	public function getFields() {
		$fields = array('legend' => false);
		foreach ($this->schema() as $key => $value) {
			if ($key == 'año') {
				$fields['Book.year'] = array(
					'label' => 'Año',
					'type' => 'date',
					'minYear' => '1880',
					'maxYear' => date('Y'),
					'dateFormat' => 'Y',
					'name' => 'data[Book][año]');
			} else {
				array_push($fields, $this->name . '.' . $key);
			}
		}

		return $fields;
	}

}
