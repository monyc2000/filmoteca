<?php

class ShopController extends AppController {

	public function index() {
		$this->loadModel('Item');

		$this->set('categories', $this->Item->ShopCategory->find('all', array(
					'recursive' => 0,
					'order' => array('ShopCategory.id')
		)));

		$souvenirs = $this->Item->find('all', array(
			'conditions' => array(
				'activo' => true,
				'or' => array(
					'shop_category_id' => array(4, 5, 6, 7)
				)
			)
		));

		$books = $this->Item->find('all', array(
			'conditions' => array(
				'activo' => true,
				'shop_category_id' => 2
		)));

		$films = $this->Item->find('all', array(
			'conditions' => array(
				'activo' => true,
				'shop_category_id' => 3
			))
		);
		$this->set('souvenirs', $souvenirs);
		$this->set('books', $books);
		$this->set('films', $films);
	}

}
