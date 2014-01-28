<?php

class BooksController extends AppController {

	public $scaffold = 'admin';
	public $components = array('Paginator');
	public $paginate = array(
		'limit' => 25,
		'order' => array(
			'Book.[1]' => 'asc'
		)
	);

	public function detail($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Libro invalido.'));
		}
		$tmp = $this->Book->find('first', array(
			'conditions' => array(
				'Book.id' => $id),
			'recursive' => -1
		));

		if (empty($tmp)) {
			throw new NotFoundException(__('Libro invalido.'));
		}

		$this->set('id', $tmp['Book']['id']);
		$this->set('titulo', $tmp['Book']['título']);
		$this->set('sinopsis', $tmp['Book']['sinopsis']);

		unset($tmp['Book']['id']);
		unset($tmp['Book']['item_id']);
		unset($tmp['Book']['título']);
		unset($tmp['Book']['sinpsis']);


		$this->set('bookDetails', $tmp['Book']);

		$fromFacebook = false;

		if ($fromFacebook) {
			$this->layout = 'default';
		} else {
			$this->layout = 'ajax';
		}
	}

}
