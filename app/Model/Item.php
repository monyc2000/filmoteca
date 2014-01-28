<?php

class Item extends AppModel {

	public $name = 'Item';
	public $belongsTo = 'ShopCategory';
	public $hasOne = array(
		'Souvenir',
		'Book',
		'Film'
	);

	public function normalize($model, $name, $val) {
		$ms = strtolower($model) . 's';
		$item = array();
		$item['url'] = array('controller' => $ms, 'action' => 'detail', $val[$model]['id']);
		$item['imageUrl'] = $ms . '/thumbnail_' . $val[$model]['id'] . '.jpg';
		$item['nombre'] = $val[$model][$name];

		return $item;
	}

}
