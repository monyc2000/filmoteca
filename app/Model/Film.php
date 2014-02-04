<?php

class Film extends AppModel {

	public $name = "Film";
	public $hasMany = array("Exhibition");
	public $belongsTo = "Genre";
	public $displayField = 'titulo';

	public function getFields($genre_id = 1) {
		$fields = array('legend' => false);

		foreach ($this->schema() as $key => $value) {
			switch ($key) {
				case ('año'):
					$fields['Film.year'] = array(
						'label' => 'Año',
						'type' => 'date',
						'minYear' => '1880',
						'maxYear' => date('Y'),
						'dateFormat' => 'Y',
						'name' => 'data[Film][año]');
					break;
				case('genre_id'):
					$fields['Film.genre_id'] = array('label' => 'Género', 'selected' => $genre_id);
					break;
				default:
					array_push($fields, $this->name . '.' . $key);
			}
		}

		return $fields;
	}

}
