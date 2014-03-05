<?php

class CourseDetailsController extends CoursesAppController {
	
	public function admin_add() {

		parent::admin_add();
		
		$courses = $this->CourseDetail->Course->find('list'
				, array('fields' =>
			array('id', 'nombre')));
		$professors = $this->CourseDetail->Professor->find('list'
				, array('fields' =>
			array('id', 'nombre')));
		$venues = $this->CourseDetail->Venue->find('list'
				, array('fields' =>
			array('id', 'nombre')));
		
		$this->set('courses', $courses);
		$this->set('professors', $professors);
		$this->set('venues', $venues);
	}

	public function admin_edit($id = null){
		
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
		
		$courses = $this->CourseDetail->Course->find('list'
				, array('fields' =>
			array('id', 'nombre')));
		$professors = $this->CourseDetail->Professor->find('list'
				, array('fields' =>
			array('id', 'nombre')));
		$venues = $this->CourseDetail->Venue->find('list'
				, array('fields' =>
			array('id', 'nombre')));
				
		$fields = $this->CourseDetail->getInputFields($data);

		$this->set('model', $model);
		$this->set('fields', $fields);
		$this->set('fieldsBlackList', array());
		
		$this->set('courses', $courses);
		$this->set('professors', $professors);
		$this->set('venues', $venues);
	}
	
	public function admin_index() {

		$model = $this->modelClass;
		$fields = $this->$model->getColumnsName();

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5
		);
				
		$this->set('titles', $fields);
		$this->set('data', $this->Paginator->paginate('CourseDetail'));
		$this->set('model', $model);
	}
}
