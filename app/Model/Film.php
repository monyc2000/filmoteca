<?php

class Film extends AppModel {

	public $name = "Film";
	public $hasMany = array("Exhibition");
	public $belongsTo = "Genre";

	public function getFieldInputs($genre_id = 1, $año = 2014) {
		$fields = array('legend' => false);
		$titles = array_keys($this->schema());

		foreach ($titles as $val) {
			switch ($val) {
				case ('año'):
					$fields['Film.year'] = array(
						'label' => 'Año',
						'selected' => $año . '-01-01 00:00:00',
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
					array_push($fields, $this->name . '.' . $val);
			}
		}

		return $fields;
	}

	/**
	 * Recibe un arreglo obtenido del metodo find y los compacta de tal manera
	 * que los campos de relación, en este caso genre_id, se cambien por
	 * el valor de de interes para el usuario.
	 * 
	 * @param type $data
	 * @return array
	 */
	public function compact($data, $model = "Film") {
		$newData = array();
		foreach ($data as $datum) {
			$datum['Film']['genre_id'] = $datum['Genre']['género'];
			array_push($newData, $datum);
		}
		return $newData;
	}

	public function getMetatagsForOpengraph($id, $title) {
		return array(
			array('property' => 'og:title', 'content' => $title),
			array('property' => 'og:type', 'content' => 'video.movie'),
			array('proporty' => 'og:url',
				'content' => Router::url(array(
					'full_base' => true,
					'controller' => 'films',
					'action' => 'detail',
					$id))),
			array('property' => 'og:image', 'content' => Router::url('/', true) . 'imgs/films/thumbnail_' . $id . '.jpg')
		);
	}

	public function deleteImage($id) {
		$imgThumb = WWW_ROOT . 'img' . DS . strtolower($this->name) . 's' . DS . 'thumbnail_' . $modelId . '.jpg';
		$imgFull = WWW_ROOT . 'img' . DS . strtolower($this->name) . 's' . DS . 'full_' . $modelId . '.jpg';

		if (file_exists($imgThumb)) {
			unlink($imgThumb);
		}

		if (file_exists($imgFull)) {
			unlink($imgFull);
		}
	}

}
