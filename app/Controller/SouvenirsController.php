<?php

class SouvenirsController extends AppController {

	public $scaffold = 'admin';

	public function detail($id = null) {
//		$s = $this->Souvenir->find('first', array(
//			'conditions' => array('id' => $id),
//			'recursive' => -1
//		));

		if (!$id) {
			throw new NotFoundException(__('Souvenir no invalido.'));
		}

		$s = $this->Souvenir->findById($id);

		if (!$s) {
			throw new NotFoundException(__('Souvenir no invalido.'));
		}

		$this->set('souvenir', $s['Souvenir']);

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		} else {
			$this->layout = 'default';
		}
	}

}
