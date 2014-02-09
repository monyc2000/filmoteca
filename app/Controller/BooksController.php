<?php

class BooksController extends AppController {
	
	public function detail($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Libro invalido.'));
		}
		$tmp = $this->Book->findById($id);

		if (empty($tmp)) {
			throw new NotFoundException(__('Libro invalido.'));
		}

		$this->set('id', $tmp['Book']['id']);
		$this->set('titulo', $tmp['Book']['título']);
		$this->set('sinopsis', $tmp['Book']['sinopsis']);

		if (empty($tmp['Book']['subtítulo'])) {
			$this->set('subitulo', $tmp['Book']['subtítulo']);
		}

		unset($tmp['Book']['id']);
		unset($tmp['Book']['item_id']);
		unset($tmp['Book']['título']);
		unset($tmp['Book']['subtítulo']);
		unset($tmp['Book']['sinpsis']);


		$this->set('bookDetails', $tmp['Book']);

		$fromFacebook = isset($_GET["_escaped_fragment_"]);
		if ($fromFacebook || !$this->request->is('ajax')) {
			$this->layout = 'default';
		} else {
			$this->layout = 'ajax';
		}
	}

	public function admin_index() {
		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5,
			'recursive' => 1
		);

		$model = $this->modelClass;
		$titles = array_keys($this->$model->schema());
		$data = $this->Paginator->paginate($model, array(), $titles);

		$this->set('data', $data);
		$this->set('titles', $titles);
		$this->set('model', $model);
	}

}
