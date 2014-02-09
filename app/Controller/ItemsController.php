<?php

class ItemsController extends AppController {

	public function admin_add() {

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = __('No fue posible guardar el artículo.');

		if ($this->request->is('post')) {
			if ($this->Item->saveAssociated($this->request->data)) {

				switch ($this->request->data['Item']['shop_category_id']) {
					case (3):
						$tmp = $this->ImageUploader->uploadThem('Film', $this->Item->Film->id, $this->request->data);
						break;
					case (2):
						$tmp = $this->ImageUploader->uploadThem('Book', $this->Item->Book->id, $this->request->data);
						break;
					default:
						$tmp = $this->ImageUploader->uploadThem('Souvenir', $this->Item->Souvenir->id, $this->request->data);
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

		$this->set('genres', $this->Item->Film->Genre->find('list', array(
					'fields' => array(
						'id', 'género'))));

		$bookFields = $this->Item->Book->getFieldInputs();
		$filmFields = $this->Item->Film->getFieldInputs();

		$this->set('bookFields', $bookFields);
		$this->set('bookBlackList', array('id', 'item_id'));

		$this->set('filmFields', $filmFields);
		$this->set('filmBlackList', array('id', 'item_id'));
	}

	public function admin_edit($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Artículo invalido'));
		}

		$item = $this->Item->findById($id);

		if (!$item) {
			throw new NotFoundException(__('Artículo invalido'));
		}

		switch ($item['ShopCategory']['id']) {
			case (3):

				if ($this->request->is(array('post', 'put'))) {
					$genero = $this->request->data['Film']['genre_id'];
					$año = $this->request->data['Film']['año'];
				} else {
					$genero = $item['Film']['genre_id'];
					$año = $item['Film']['año'];
				}

				$fields = $this->Item->Film->getFieldInputs($genero, $año);
				$model = 'Film';
				$this->set('genres', $this->Item->Film->Genre->find('list', array(
							'fields' => array(
								'id', 'género'))));
				break;
			case(2):
				if ($this->request->is(array('post', 'put'))) {
					$año = $this->request->data['Book']['año'];
				} else {
					$año = $item['Book']['año'];
				}
				$fields = $this->Item->Book->getFieldInputs($año);
				$model = 'Book';
				break;
			default:
				$fields = $this->Item->Souvenir->getFieldInputs();
				$model = 'Souvenir';
				break;
		}

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = "No se pudo acualizar el artículo.";

		if ($this->request->is(array('post', 'put'))) {
			$this->request->data[$model]['id'] = $item[$model]['id'];
			$this->request->data['Item']['id'] = $id;

			if ($this->Item->saveAssociated($this->request->data)) {
				$tmp = $this->ImageUploader->uploadThem($model, $item[$model]['id'], $this->request->data);
				if (is_bool($tmp) && $tmp) {
					$message = "Artículo editado.";
				} else {
					$message .= $tmp;
				}
			}

			$this->Session->setFlash(__($message));
		}

		$this->set('fields', $fields);
		$this->set('blackList', array('id', 'item_id'));
		$this->set('model', $model);

		if (empty($this->request->data)) {
			$this->request->data = $item;
		}
	}

	/**
	 * Nombre del modelo de los artículos que se deasea editar. 
	 * @param string $model
	 */
	public function admin_index($model = "Souvenir") {

		switch ($model) {
			case("Book"):
				$category = "Libros";
				$shop_category_id = 2;
				break;
			case("Film"):
				$category = "Películas";
				$shop_category_id = 3;
				break;
			default:
				$category = "Artículos Promocionales";
				$shop_category_id = array(4, 5, 6, 7);
				break;
		}

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5,
			'recursive' => 1,
			'conditions' => array(
				'shop_category_id' => $shop_category_id
			),
			'fields' => array(
				'Item.*',
				'Film.título',
				'Film.id',
				'Book.título',
				'Book.id',
				'Souvenir.id',
				'Souvenir.nombre'
			)
		);

		$specificTitles = array('título');

		$itemTitles = array_keys($this->Item->schema());
		unset($itemTitles[array_search('shop_category_id', $itemTitles)]);
		$titles = array_merge($itemTitles, $specificTitles);

		$data = $this->Paginator->paginate('Item');

		$this->set('data', $this->Item->compact($data, $model));
		$this->set('titles', $titles);
		$this->set('model', 'Item');
		$this->set('category', $category);
	}

	public function admin_delete($id = null) {

		if (empty($id)) {
			throw new NotFoundException();
		}

		$data = $this->Item->findById($id, 'Item.shop_category_id');

		if (empty($data)) {
			throw new NotFoundException();
		}

		$model = $this->Item->ShopCategory->getAssociatedModel($data['Item']['shop_category_id']);

		$modelId = $this->Item->$model->find('first', array(
					'fields' => 'id',
					'conditions' => array(
						'item_id' => $id
					)
				))[$model]['id'];
		debug($modelId);


		if ($this->Item->delete($id)) {
			$this->Session->setFlash(__('Artículo borrado para siempre.'));

			if ($model !== 'Film') {
				unlink(WWW_ROOT . 'img' . DS . strtolower($model) . 's' . DS . 'full_' . $modelId . '.jpg');
				unlink(WWW_ROOT . 'img' . DS . strtolower($model) . 's' . DS . 'thumbnail_' . $modelId . '.jpg');
			}
		}

		$this->redirect(array('action' => 'index', $model));
	}
	
	public function admin_on_off($id = null, $on_off){
		
		$on_off = ($on_off + 1) % 2;
		
		if(empty($id)){
			throw new NotFoundException();
		}
		
		$data = $this->Item->findById($id, 'Item.shop_category_id');

		if (empty($data)) {
			throw new NotFoundException();
		}

		$model = $this->Item->ShopCategory->getAssociatedModel($data['Item']['shop_category_id']);
		
		$this->Item->id = $id;
		$this->Item->saveField('activo',$on_off);
		$this->redirect(array('action' => 'index',$model ));
	}

	public function detail($id = null) {

		if (empty($id)) {
			throw new NotFoundException();
		}

		$data = $this->Item->findById($id, 'shop_category_id');

		if (empty($data)) {
			throw new NotFoundException();
		}

		$model = $this->Item->ShopCategory->getAssociatedModel($data['Item']['shop_category_id']);
		$id = $this->Item->$model->find('first', array(
			'conditions' => array(
				'item_id' => $id
			),
			'fields' => array('id')
		));
		$this->redirect(array('controller' => strtolower($model) . 's', 'action' => 'detail', $id[$model]['id']));
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
					'Item.existencias',
					'Film.título',
					'Book.título',
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

}
