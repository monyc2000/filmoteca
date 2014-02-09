<?php

class Book extends AppModel {

	public $name = 'Book';
	public $belongsTo = 'Item';

	public function getFieldInputs($año = 2014) {
		$fields = array('legend' => false);
		$titles = array_keys($this->schema());
		
		foreach ($titles as $val) {
		switch ($val) {
				case ('año'):
					$fields['Book.year'] = array(
					'label' => 'Año',
					'selected' => $año .'-01-01 00:00:00',
					'type' => 'date',
					'minYear' => '1880',
					'maxYear' => date('Y'),
					'dateFormat' => 'Y',
					'name' => 'data[Book][año]');
					break;
				default:
					array_push($fields, $this->name . '.' . $val);
			}
		}

		return $fields;
	}
}
