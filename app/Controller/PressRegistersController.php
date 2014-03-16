<?php

App::uses('CakeEmail', 'Network/Email');

class PressRegistersController extends AppController {

	public function add() {

		if ($this->request->is('post')) {
			if (!is_numeric($this->request->data['PressRegister']['tipo_de_medio'])) {
				throw new NotFoundException();
			}
			if ($this->PressRegister->save($this->request->data)) {
				$tipo_de_medio = $this->request->data['PressRegister']['tipo_de_medio'];
				$tmp = $this->PressRegister
						->query('select nombre from tipos_de_medios where id = ' . $tipo_de_medio . ' limit 1;');

//				$this->request->data['PressRegister']['tipo_de_medio'] = $tmp[0]['tipos_de_medios']['nombre'];
//				$email = new CakeEmail();
//				$email->template('press_register', 'default')
//						->emailFormat('html')
//						->viewVars(array('data' => $this->request->data))
//						->to('victor.aguilar@ciencias.unam.mx')
//						->from('victor.aguilar@yahoo.com.mx')
//						->send();
				$this->Session->setFlash(__('Registrado.'),'default',array('class' => 'alert alert-success'));
				$this->request->data = null;
			} else {
				$this->Session->setFlash(__('No se puedo realizar el registro.'));
			}
		}

		$this->set('tipos_de_medios', $this->PressRegister->query('Select * from tipos_de_medios'));
		$this->set('fields', $fields = $this->PressRegister->schema());
		$this->set('blackList', array('id', 'tipo_de_medio', 'fecha_del_registro'));
	}

	public function admin_index() {

		$conditions = array();
		if ($this->request->is('post')) {

			foreach ($this->request->data as $key => $val) {
				if (!empty($val)) {
					array_push($conditions, array(
						$key . '(PressRegister.fecha_del_registro) = ' =>
						$val));
				}
			}
		}

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5,
			'order' => array('PressRegister.fecha_del_registro' => 'DESC'),
			'recursive' => 2,
			'joins' => array(
				array(
					'table' => 'tipos_de_medios',
					'alias' => 'TipoDeMedio',
					'type' => 'left',
					'conditions' => array(
						'PressRegister.tipo_de_medio = TipoDeMedio.id'
					)
				)
			),
			'fields' => array(
				'PressRegister.*',
				'TipoDeMedio.nombre'),
			'conditions' => $conditions
		);

		$model = $this->modelClass;
		$data = $this->Paginator->paginate($model);

		$this->set('data', $data);
		$this->set('titles', array_keys($this->$model->schema()));
		$this->set('model', $model);
	}

}
