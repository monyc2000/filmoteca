<?php

class FilmsController extends AppController {

	public $scaffold = 'admin';
	public $components = array('Paginator');
	public $paginate = array(
		'limit' => 25,
		'order' => array(
			'Film.[1]' => 'asc'
		)
	);

	public function add() {

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = 'No se pudo guardar la película.';

		if ($this->request->is('post')) {
			if ($this->Film->saveAssociated($this->request->data)) {
				$tmpMess = $this->ImageUploader->uploadThem('Film', $this->Film->id, $this->request->data);
				$this->request->data = null; //reset formulario;$this->data = null; //reset formulario;

				$message = "Película agregada. <br>" . (is_bool($tmpMess)) ? '' : $tmpMess;
			}

			$this->Session->setFlash(__($message));
		}

		$filmFields = $this->Film->getFields();
		$this->set('genres', $this->Film->Genre->find('list', array('fields' => array(
						'id', 'género'))));
		$this->set('filmFields', $filmFields);
		$this->set('filmBlackList', array('item_id'));
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		} else {
			$this->layout = 'default';
		}
	}

	public function detail($id) {

		if (!$id) {
			throw new NotFoundException(__('Película Invalida.'));
		}

		$this->loadModel('Router');

		$film = $this->Film->find('first', array(
			'conditions' => array(
				'Film.id' => $id),
			'recursive' => 0
		));

		if (!$film) {
			throw new NotFoundException(__('Película Invalida.'));
		}

		$fromFacebook = isset($_GET["_escaped_fragment_"]);
		$mt = array(
			array('property' => 'og:title', 'content' => $film['Film']['título']),
			array('property' => 'og:type', 'content' => 'video.movie'),
			array('proporty' => 'og:url',
				'content' => $this->Router->url(array(
					'controller' => 'films',
					'action' => 'detail',
					$film['Film']['id']))),
			array('property' => 'og:image', 'content' => Router::url('/', true) . 'imgs/films/thumbnail_' . $id . '.jpg')
		);

		$this->set('mt', $mt);

		$this->set('titulo', $film['Film']['título']);
		$this->set('sinopsis', $film['Film']['sinopsis']);
		$this->set('url_trailer', $film['Film']['url_trailer']);
		$this->set('id', $film['Film']['id']);

		$film['Film']['Género'] = $film['Genre']['género'];

		unset($film['Film']['item_id']);
		unset($film['Film']['genre_id']);
		unset($film['Film']['título']);
		unset($film['Film']['sinopsis']);
		unset($film['Film']['url_trailer']);
		unset($film['Film']['id']);
		$this->set('details', $film['Film']);

		if ($fromFacebook || !$this->request->is('ajax')) {
			$this->layout = 'default';
		} else {
			$this->layout = 'ajax';
		}
	}

	public function edit($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Película invalido'));
		}

		$film = $this->Film->findById($id);

		if (!$film) {
			throw new NotFoundException(__('Película invalido'));
		}

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = 'No se pudo actualizar la película.';

		$genre_id = $film['Film']['genre_id'];

		if ($this->request->is(array('post', 'put'))) {
			$this->Film->id = $id;
			$genre_id = $this->request->data['Film']['genre_id'];
			if ($this->Film->save($this->request->data)) {
				$tmpMess = $this->ImageUploader->uploadThem('Film', $this->Film->id, $this->request->data);

				$message = 'Pelicula actualizada. <br>' . (is_bool($tmpMess)) ? '' : $tmpMess;
			}
			$this->Session->setFlash(__($message));
		}

		$filmFields = $this->Film->getFields($genre_id);
		$this->set('filmFields', $filmFields);
		$this->set('filmBlackList', array('item_id'));
		$this->set('genres', $this->Film->Genre->find('list', array(
					'fields' => array(
						'id', 'género')
						)
		));

		if (empty($this->request->data)) {
			$this->request->data = $film;
		}
	}

	public function list_films() {
		$this->response->type('json');
		$data = $this->Film->find('all', array(
			'limit' => 2,
			'conditions' => array('Film.título LIKE' => '%' . $this->request->params['named']['titulo'] . '%')
		));

		$newData = array();

		foreach ($data as $v) {
			array_push($newData, array(
				'label' => $v['Film']['título'],
				'value' => '(' . $v['Film']['id'] . ') ' . $v['Film']['título']));
		}

		$this->set('data', $newData);

		$this->layout = 'ajax';
	}

}
