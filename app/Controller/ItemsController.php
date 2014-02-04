<?php

class ItemsController extends AppController {

	public $scaffold = 'admin';

	public function add() {
		$this->loadModel('Film');
		$this->loadModel('Book');
		$this->loadModel('Souvenir');

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = __('No fue posible guardar el artículo.');

		if ($this->request->is('post')) {
			if ($this->Item->saveAssociated($this->request->data)) {

				switch ($this->request->data['Item']['shop_category_id']) {
					case (3):
						$tmp = $this->ImageUploader->uploadThem('Film', $this->Film->id, $this->request->data);
						break;
					case (2):
						$tmp = $this->ImageUploader->uploadThem('Book', $this->Book->id, $this->request->data);
						break;
					default:
						$tmp = $this->ImageUploader->uploadThem('Souvenir', $this->Souvenir->id, $this->request->data);
						break;
				}

				$this->data = null; //Reiniciar formulario

				$message = "Artículo agregado.<br>";

				if (!(is_bool($tmp) && $tmp)) {
					$message .= $tmp;
				}
			}

			$this->Session->setFlash($message);
		}

		$this->set('shopCategories'
				, $this->Item->ShopCategory->find('list', array(
					'fields' => array(
						'id', 'nombre')
					, 'order' => array('ShopCategory.id'))));
		$this->set('genres', $this->Film->Genre->find('list', array(
					'fields' => array(
						'id', 'género')
						)
		));

		$bookFields = $this->Book->getFields($this->Item->Book);
		$filmFields = $this->Film->getFields($this->Item->Film);

		$this->set('bookFields', $bookFields);
		$this->set('bookBlackList', array('id', 'item_id'));

		$this->set('filmFields', $filmFields);
		$this->set('filmBlackList', array('id', 'item_id'));
	}

	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Artículo invalido'));
		}

		$item = $this->Item->findById($id);

		if (!$item) {
			throw new NotFoundException(__('Artículo invalido'));
		}

		switch ($item['ShopCategory']['id']) {
			case (3):
				$fields = $this->getFields($this->Item->Film);
				$modelId = $item['Film']['id'];
				$this->Item->Film->id = $modelId;
				$model = 'Film';
				break;
			case(2):
				$fields = $this->getFields($this->Item->Book);
				$modelId = $item['Book']['id'];
				$this->Item->Book->id = $modelId;
				$model = 'Book';
				break;
			default:
				$fields = $this->getFields($this->Item->Souvenir);
				$modelId = $item['Souvenir']['id'];
				$this->Item->Souvenir->id = $modelId;
				$model = 'Souvenir';
				break;
		}

		$this->set('fields', $fields);
		$this->set('blackList', array('id', 'item_id'));
		$this->set('model', $model);

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = "No se pudo acualizar el artículo.";

		if ($this->request->is(array('post', 'put'))) {
			$this->request->data[$model]['id'] = $modelId;
			$this->Item->id = $id;

			$a = $this->Item->save($this->request->data['Item']);
			$b = $this->Item->$model->save($this->request->data[$model]);
			if (($a && $b)) {
				$tmp = $this->ImageUploader->uploadThem($model, $modelId, $this->request->data);
				if (is_bool($tmp) && $tmp) {
					$message = "Artículo editado.";
				} else {
					$message .= $tmp;
				}
			}

			$this->Session->setFlash(__($message));
		}

		if (!$this->request->data) {
			$this->request->data = $item;
		}
	}

	public function addToCart($itemId = null, $amount = 1) {

		if (!$itemId || $amount <= 0) {
			throw new NotFoundException(__('Artículo o cantidad invalida.'));
		}

		if ($this->Session->check('cart.' . $itemId)) {
			$tmp = $this->Session->read("cart.$itemId.cantidad");
			$this->Session->write("cart.$itemId.cantidad", $tmp + $amount);
		} else {
			$item = $this->Item->find('first', array(
				'conditions' => array(
					'Item.id' => $itemId,
					'Item.activo' => true
				),
				'fields' => array(
					'Item.precio_general',
					'Item.precio_especial',
					'Item.in_stock',
					'Film.titulo',
					'Book.titulo',
					'Souvenir.nombre'
				)
			));

			if (empty($item)) {
				throw new NotFoundException(__('Artículo no encontrada'));
			}

			$name = (isset($item['Film']['titulo'])) ? $item['Film']['titulo'] : "";
			$name .= (isset($item['Book']['titulo'])) ? $item['Book']['titulo'] : "";
			$name .= (isset($item['Souvenir']['nombre'])) ? $item['Souvenir']['nombre'] : "";

			$this->Session->write("cart.$itemId.nombre", $name);
			$this->Session->write("cart.$itemId.precio_de_venta", $item['Item']['precio_general']);
			$this->Session->write("cart.$itemId.item_id", $itemId);
			$this->Session->write("cart.$itemId.cantidad", $amount);
		}

		$this->Session->setFlash(__('Artículo agregado.'));
		$this->set('data', $this->Session->read('cart'));
		$this->layout = "ajax";
	}

	public function removeFromCart($itemId = null, $amount = 1) {

		if (!$itemId || $amount <= 0) {
			throw new NotFoundException(__('Artículo o cantidad invalida.'));
		}

		if (!$this->Session->check("cart.$itemId")) {
			throw new NotFoundException(__('Artículo invalido'));
		}

		$newAmount = $this->Session->read("cart.$itemId.cantidad") - $amount;

		if ($newAmount <= 0) {
			$this->Session->delete("cart.$itemId");
		} else {
			$this->Session->write("cart.$itemId.cantidad", $newAmount);
		}

		$this->Session->setFlash(__('Artículo removido.'));
		$this->set('data', $this->Session->read('cart'));
		$this->layout = "ajax";
	}

	public function showCart() {
		
	}

	private function getFields($model) {
		$fields = array('legend' => false);
		foreach ($model->schema() as $key => $value) {
			array_push($fields, $model->name . '.' . $key);
		}

		return $fields;
	}

	private function getSpecificItem($item) {
		$l = array('Film', 'Book', 'Souvenir');

		foreach ($l as $val) {
			if (!empty($item[$val]['id'])) {
				switch ($val) {
					case ('Film'):
						return $this->Item->Film;
					case ('Book'):
						return $this->Item->Book;
					case ('Souvenir'):
						return $this->Item->Souvenir;
				}
			}
		}
	}

}
