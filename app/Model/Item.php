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
	
	public function compact($data,$model){
		$newData = array();
		foreach($data as $datum){
			unset($datum[$model]['id']);
			unset($datum[$model]['item_id']);
			unset($datum['Item']['shop_category_id']);
			$datum['Item']['activo'] = ($datum['Item']['activo'])? __('Sí'): __('No');
			$newRow['Item'] = array_merge($datum['Item'], $datum[$model]);
			array_push($newData,$newRow);
		}
		return $newData;
	}

}
