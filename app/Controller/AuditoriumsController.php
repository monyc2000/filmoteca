<?php

class AuditoriumsController extends AppController {

	public function index() {
		$menu = array();
		$auditoriums = array();
		$listOfAuditoriums = $this->Auditorium->find('threaded', array(
			'conditions' => array(
				'Auditorium.zone' => null
		)));

		foreach ($listOfAuditoriums as $value) {

			$classParentFilter = strtolower(
					str_replace(' ', '_', $value['Auditorium']['nombre']));

			array_push($auditoriums, array(
				'nombre' => $value['Auditorium']['nombre'],
				'classFilter' => $classParentFilter,
				'imageUrl' => 'auditoriums/thumbnail_' . $value['Auditorium']['id'] . '.jpg',
				'id' => $value['Auditorium']['id']
			));

			$subMenu = array();

			if (!empty($value['SubAuditorium'])) {
				foreach ($value['SubAuditorium'] as $sub) {
					$classSubFilter = strtolower(
							str_replace(' ', '_', $sub['nombre']));
					array_push($auditoriums, array(
						'nombre' => $sub['nombre'],
						'classFilter' => $classParentFilter . ' ' . $classSubFilter,
						'imageUrl' => 'auditoriums/thumbnail_' . $value['Auditorium']['id'] . '.jpg',
						'id' => $sub['id']
					));

					array_push($subMenu, array(
						'nombre' => $sub['nombre'],
						'classFilter' => $classSubFilter
					));
				}
			}

			$menuEntry = array(
				'nombre' => $value['Auditorium']['nombre'],
				'classFilter' => $classParentFilter,
				'subAuditorium' => $subMenu
			);

			array_push($menu, $menuEntry);
		}

		$this->set('menu', $menu);
		$this->set('auditoriums', $auditoriums);
	}

	public function detail($id = null) {

		if (!$id) {
			throw new NotFoundException(__('La sala no existe.'));
		}

		$auditorium = $this->Auditorium->findById($id);

		if (!$auditorium) {
			throw new NotFoundException(__('La sala no existe.'));
		}

		$this->set('auditorium', $auditorium['Auditorium']);

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		} else {
			$this->layout = 'default';
		}
	}

	public function admin_add() {

		$this->ImageUploader = $this->Components->load('ImageUploader');

		$message = 'Hubo un problema al guardar.';
		if ($this->request->is('post')) {
			if ($this->Auditorium->save($this->request->data)) {

				$imgMessage = $this->ImageUploader->uploadThem('Auditorium', $this->Auditorium->id, $this->request->data);

				if (is_bool($imgMessage) && $imgMessage) {
					$message = 'Sala guardada.';
				} else {
					$message .= $imgMessage;
				}
			}

			$this->Session->setFlash($message);
		}

		$this->set('zones', $this->Auditorium->find('list', array(
					'fields' => array('Auditorium.id', 'Auditorium.nombre'),
					'order' => array('Auditorium.nombre ASC')
		)));
	}

	public function delete() {
		
	}

	public function admin_edit($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Sala Invalida'));
		}

		$auditorium = $this->Auditorium->findById($id);

		if (!$auditorium) {
			throw new NotFoundException(__('Sala Invalida'));
		}

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = 'No se pudo actualizar la sala.';

		if ($this->request->is(array('post', 'put'))) {

			$this->Auditorium->id = $id;

			if ($this->Auditorium->save($this->request->data)) {
				$tmpMess = $this->ImageUploader->uploadThem('Auditorium', $this->Auditorium->id, $this->request->data);
				if (!is_bool($tmpMess) && $tmpMess) {
					$message .= $tmpMess;
				} else {
					$message = 'Sala actualizada.';
				}
			}
			$this->Session->setFlash(__($message));
		}

		$this->set('zones', $this->Auditorium->find('list', array(
					'fields' => array('Auditorium.id', 'Auditorium.nombre'),
					'order' => array('Auditorium.nombre ASC')
		)));

		if (!$this->request->data) {
			$this->request->data = $auditorium;
		}
	}

}
