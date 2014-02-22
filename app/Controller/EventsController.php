<?php

/**
 * Description of EventsController
 *
 * @author victor
 */

require_once( APP . 'Vendor' . DS . 'ExtraFunctions' . DS . 'ExtraFunctions.php');

class EventsController extends AppController {

	public function admin_add() {

		if ($this->request->is('post')) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('Evento guardado.'));
			} else {
				$this->Session->setFlash(__('Ocurrio un problema al guardar el evento.'));
			}
		}

		$fields = $this->Event->getColumnsName();

		$this->set('model', 'Event');
		$this->set('fields', $this->Event->getFieldInputs());
		$this->set('fieldsBlackList', array());
	}

	public function admin_index() {
		$fields = $this->Event->getColumnsName();

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5
		);
		$this->set('titles', $fields);
		$this->set('data', $this->Paginator->paginate('Event'));
		$this->set('model', 'Event');
	}
	
	public function admin_delete($id = null){
		
		if( empty($id)){
			throw new NotFoundException(__('Evento no encontrado.'));
		}
		
		$result = $this->Event->delete($id);
		
		if($result){
			$this->Session->setFlash(__('Evento borrado.'));
			
			rrmdir(WWW_ROOT .  'files' . DS . 'eventos' . DS .$id);
		}else{
			$this->Session->setFlash(__('No se pudo borrar el evento.'));
		}
		
		$this->redirect('/admin/events/index');
	}

}
