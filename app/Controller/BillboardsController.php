<?php

App::uses('CMSController', 'Controller');

class BillboardsController extends CMSController{
	
	public function admin_index() {

		$model = $this->modelClass;

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5,
			'fields' => array_keys($this->{$model}->titles)
		);

		$data = $this->Paginator->paginate($model);

		$this->set('data', $this->{$model}->toTable($data));
		$this->set('subtitle','Administración de ' . __($this->{$model}->name));
		$this->set('modelName', $model);
		$this->set('model', $this->{$model});

		$this->render('/Commons/admin_plus_index');
	}

	public function admin_add(){
		$model = $this->modelClass;

		if( $this->request->is('post')){
			if( $this->{$model}->saveAssociated($this->request->data)){
				$this->Session->setFlash(
					__('Agregado.'),
					'default',
					array('class' => 'alert alert-success'));
			}else{
				$this->Session->setFlash(
					__('Problemas al agregar.'),
					'default',
					array('class' => 'alert alert-danger'));
			}
		}

		$this->set('subtitle','Agregar ' . __($this->{$model}->name));
		$this->set('model', $this->{$model});
		$this->render('/Commons/admin_plus_add');
	}

	public function admin_delete($id = null){

		$model = $this->modelClass;

		if( empty($id)){
			throw new Exception(__('Registro Invalido.'));
		}

		$this->{$model}->id = $id;

		if($this->{$model}->delete($id)){
			$this->Session->setFlash(
					__('Borrado.'),
					'default',
					array('class' => 'alert alert-success'));

		}else{
			$this->Session->setFlash(
					__('Problema al borrar.'),
					'default',
					array('class' => 'alert alert-danger'));
		}

		$this->redirect('index');
	}

	/**
	  * Esta función debería ser llamada a travéz de ajax.
	  */
	public function subscribe(){

		$model = $this->modelClass;

		if($this->request->is('post')){
			if( $this->{$model}->saveSubscriber($this->request->data['email']) ){
				$this->set('message', __('Subscrito.'));
				$this->layout = 'ajax';
				$this->render('/Commons/ajax/success');
			}else{
				$this->set('message', __('El email ya existe.'));
				$this->layout = 'ajax';
				$this->render('/Commons/ajax/error');
			}
		}
	}
}