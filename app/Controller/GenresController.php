<?php

/**
 * Description of GenreController
 *
 * @author victor
 */
class GenresController extends AppController {

	public $scaffold = 'admin';

	public function add() {

		if ($this->request->is('post')) {
			if ($this->Genre->save($this->request->data)) {
				$this->data = null;
				$this->Session->setFlash('Género agregado.');
			} else {
				$this->Session->setFlas('No se pudo agregar el nuevo género.');
			}
		}
	}

}
