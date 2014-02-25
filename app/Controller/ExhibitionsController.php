<?php

class ExhibitionsController extends AppController {

	public function admin_add() {

		if ($this->request->is('post')) {
			if ($this->Exhibition->saveAssociated($this->request->data)) {
				$this->Session->setFlash('Exhibición agregada.');
				$this->request->data = null;
			} else {
				$this->Session->setFlash(__('No se pudo guardar la exhibición'
								. '. Posiblemente el nombre de la película está mal.'));
			}
		}

		$this->set('auditoriums', $this->Exhibition->Auditorium->find('list', array(
					'fields' => array('id', 'nombre'),
		)));
		$this->set('specialExhibitions', $this->Exhibition->SpecialExhibition->find('list', array(
					'fields' => array('id', 'nombre'),
					'order' => array('SpecialExhibition.nombre ASC'),
		)));
	}

	public function admin_index() {
		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5,
			'fields' => array(
				'Film.título',
				'Auditorium.nombre',
				'Exhibition.film_id'
			)
		);

		$this->set('data', $this->Paginator->paginate('Exhibition'));
		$this->set('titles', array('Id', 'Título', 'Sala', 'Portada', 'Horarios'));
		$this->set('model', 'Exhibition');
	}

	public function index() {

		$this->loadModel('Film');
		$this->loadModel('Auditorium');
		$this->loadModel('SpecialExhibition');
		$this->loadModel('Timetable');
		$this->loadMOdel('Genre');

		$generos = $this->Genre->find('list', array('fields' => array('id', 'género')));

		$auditoriums = $this->Auditorium->find('all', array(
			'fields' => array('Auditorium.nombre'),
			'recursive' => 0
		));

		$specialExhibitions = $this->SpecialExhibition->find('all', array(
			'fields' => array('SpecialExhibition.nombre'),
			'conditions' => array('SpecialExhibition.nombre != ' => "normal"),
			'recursive' => 0
		));

		$menu = array(
			'Genero' => array(),
			'Salas' => array(),
			'Mes' => null,
			'Funciones Especiales' => array()
		);

		foreach ($generos as $val) {
			array_push($menu['Genero'], $val);
		}

		foreach ($auditoriums as $val) {
			array_push($menu['Salas'], $val['Auditorium']['nombre']);
		}

		foreach ($specialExhibitions as $val) {
			array_push($menu['Funciones Especiales'], $val['SpecialExhibition']['nombre']);
		}

		$menu['Mes'] = array(
			'prev' => __(date("F", mktime(0, 0, 0, date('n') - 1, date('d'), date('y')))),
			'current' => __(date('F')),
			'next' => __(date("F", mktime(0, 0, 0, date('n') + 1, date('d'), date('y'))))
		);

		$currentMonth = date('m'); //should be in YYYY-MM-DD format

		$films = $this->Exhibition->findByDate(array(
			'OR' => array(
				'month(Timetable.fecha) = ' => array(
					$currentMonth,
					($currentMonth == 1) ? 12 : $currentMonth - 1,
					($currentMonth == 12) ? 1 : $currentMonth + 1)
		)));

		$this->set('films', $this->compactFilms($films));
		$this->set('menu', $menu);
	}

	public function miniBillboard() {

		$this->loadModel('Film');
		$this->loadModel('Auditorium');
		$this->loadModel('SpecialExhibition');
		$this->loadModel('Timetable');

		//should be in YYYY-MM-DD format
		$defaultDate = array(
			'day' => date('d'),
			'month' => date('m'),
			'year' => date('Y'));
		$date = array_merge($defaultDate, $this->request->params['named']);
		$films = $this->Exhibition->findByDate(array(
			'month(Timetable.fecha) = ' => $date['month'],
			'day(Timetable.fecha) = ' => $date['day'],
			'year(Timetable.fecha) = ' => $date['year']
		));

		$this->set('time', mktime(0, 0, 0, $date['month'], $date['day'], $date['year']));
		$this->set('films', $films);
		$this->layout = 'ajax';
	}

	public function detail($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Exhibición no encontrada.'));
		}

		$details = $this->Exhibition->findById($id);

		if (empty($details)) {
			throw new NotFoundException(__('Exhibicion no encontrada.'));
		}

		$this->set('film_id', $details['Film']['id']);
		$this->set('url_trailer', $details['Film']['url_trailer']);
		$this->set('sinopsis', $details['Film']['sinopsis']);

		unset($details['Film']['url_trailer']);
		unset($details['Film']['item_id']);

		$this->set('details', $details);

		$fromFacebook = isset($_GET["_escaped_fragment_"]);

		$mt = array(
			array('property' => 'og:title', 'content' => $details['Film']['título']),
			array('property' => 'og:type', 'content' => 'video.movie'),
			array('proporty' => 'og:url',
				'content' => Router::url(array(
					'controller' => 'films',
					'action' => 'detail',
					$details['Film']['id']))),
			array('property' => 'og:image', 'content' => 'http://ia.media-imdb.com/images/rock.jpg')
		);

		$this->set('mt', $mt);

		//Sólo renderizamos ajax cuando la solicitud es ajax pero no de facebook.
		if (!$fromFacebook && $this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
	}

	/**
	 * El objetivo de esta función es concatenar las fehcas de una película,
	 * sin embargo, por querer aprovechar la iteración sobre el resultado
	 * de la query, se hizo más grande de lo necesario.
	 * @param type $films
	 * @return array
	 */
	private function compactFilms($films) {
		if (empty($films)) {
			return array();
		}
		$getFilmData = function ($f) {
			return array(
				'film_id' => $f['Film']['id'],
				'film_titulo' => $f['Film']['título'],
				'exhibition_id' => $f['Exhibition']['id'],
				'classes' =>
				strtolower(str_replace(' ', '_', $f['Genre']['género'])) . " " .
				strtolower(str_replace(' ', '_', $f['Auditorium']['nombre'])) . " " .
				strtolower(str_replace(' ', '_', $f['SpecialExhibition']['nombre'])) . " "
			);
		};

		$newFilms = array();
		$nf = $getFilmData($films[0]);
		$meses = '';
		$currId = $nf['exhibition_id'];
		$lastFilm = null;


		foreach ($films as $v) {

			if ($v['Exhibition']['id'] == $currId) {
				$t = date_parse($v['Timetable']['fecha']);
				$tmp = strtolower(date('F', mktime(0, 0, 0, $t['month'], 1, 2013)));
				$meses .= (substr_count($meses, $tmp) == 1) ? '' : $tmp . ' ';
			} else {
				$nf['classes'] .= $meses;
				array_push($newFilms, $nf);

				$nf = $getFilmData($v);
				$t = date_parse($v['Timetable']['fecha']);
				$meses = strtolower(date('F', mktime(0, 0, 0, $t['month'], 1, 2013))) . ' ';
				$currId = $nf['exhibition_id'];
				$lastFilms = $v;
			}
		}

		$nf['classes'] .= $meses;
		array_push($newFilms, $nf);

		$t = date_parse($lastFilm['Timetable']['fecha']);
		$meses .= strtolower(date('F', mktime(0, 0, 0, $t['month'], 1, 2013))) . ' ';
		return $newFilms;
	}

}
