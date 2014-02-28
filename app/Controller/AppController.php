<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public function admin_add() {
		$model = $this->modelClass;
		if ($this->request->is('post')) {
			if ($this->$model->saveAssociated($this->request->data)) {
				$this->request->data = null;
				$this->Session->setFlash(__('Registro agregadó.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('No fue posible agregar el registro.'), 'default', array('class' => 'alert alert-danger'));
			}
		}

		$fields = $this->$model->getColumnsName();
		$fields['legend'] = false;

		$this->set('model', $model);
		$this->set('fields', $fields);
		$this->set('fieldsBlackList', array());
	}

	public function admin_index() {

		$model = $this->modelClass;
		$fields = $this->$model->getColumnsName();

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5
		);
		$this->set('titles', $fields);
		$this->set('data', $this->Paginator->paginate($model));
		$this->set('model', $model);
	}

	public function admin_delete($id = null) {

		$model = $this->modelClass;
		if (empty($id)) {
			throw new NotFoundException(__('No se encontro %s', __($model)));
		}

		if ($this->$model->delete($id)) {
			$this->Session->setFlash(__('Registro Borrado'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('No fue posible borrar el registro'), 'default', array('class' => 'alert alert-danger'));
		}

		$this->redirect(array('action' => 'index'));
	}

	public function admin_edit($id = null) {
		$model = $this->modelClass;
		if (empty($id)) {
			throw new NotFoundException(__('No se encontro %s', __($model)));
		}

		$data = $this->$model->findById($id);

		if (empty($data)) {
			throw new NotFoundException(__('No se encontro %s', __($model)));
		}

		if( $this->request->is(array('post','put'))){
			$this->$model->id = $id;
			if ($this->$model->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('Registro agregadó.'), 'default', array('class' => 'alert alert-success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('No fue posible agregar el registro.'), 'default', array('class' => 'alert alert-danger'));
			}
		}else{
			$this->request->data = $data;
		}
				
		$fields = $this->$model->getColumnsName();
		$fields['legend'] = false;

		$this->set('model', $model);
		$this->set('fields', $fields);
		$this->set('fieldsBlackList', array());
	}

}
