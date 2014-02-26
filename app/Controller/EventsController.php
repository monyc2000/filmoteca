<?php

/**
 * Description of EventsController
 *
 * @author victor
 */

require_once( APP . 'Vendor' . DS . 'ExtraFunctions' . DS . 'ExtraFunctions.php');

class EventsController extends AppController {

	public function admin_add() {

		$this->ImageUploader = $this->Components->load('ImageUploader');
		
		if ($this->request->is('post')) {
			if ($this->Event->save($this->request->data)) {
				$tmpMess = $this->ImageUploader->uploadThem('Event', $this->Event->id, $this->request->data);
				$this->Session->setFlash(__('Evento guardado. ' . $tmpMess));
			} else {
				$this->Session->setFlash(__('Ocurrio un problema al guardar el evento.'));
			}
			
			$this->request->data = null;
		}

		
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
	
	public function admin_edit($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Evento invalido'));
		}

		$event = $this->Event->findById($id);

		if (!$event) {
			throw new NotFoundException(__('Evento invalido'));
		}

		$this->ImageUploader = $this->Components->load('ImageUploader');
		$message = 'No se pudo actualizar la película.';


		if ($this->request->is(array('post', 'put'))) {
			$this->Event->id = $id;
			if ($this->Event->save($this->request->data)) {
				$tmpMess = $this->ImageUploader->uploadThem('Event', $this->Event->id, $this->request->data);

				$message = 'Pelicula actualizada. <br>' . (is_bool($tmpMess)) ? '' : $tmpMess;
			}
			$this->Session->setFlash(__($message));
		}


		$this->set('model', 'Event');
		$this->set('fields', $this->Event->getFieldInputs());
		$this->set('fieldsBlackList', array());

		if (empty($this->request->data)) {
			$this->request->data = $event;
		}
	}
	
	public function index($year = 2014){
		$data = $this->Event->find('all',array(
			'conditions' => array(
				'year(Event.fecha_de_inicio)' => $year
			)
		));
		
		$this->set('data', $data);
	}

}
