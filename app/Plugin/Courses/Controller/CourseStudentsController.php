<?php

class CourseStudentsController extends CoursesAppController{
	
	public function admin_index($course_detail_id = null){
		$model = $this->modelClass;
		$conditions = array(
			'year(CourseDetail.fecha_inicio)' => date('Y'));

		if($this->request->is('post')){

			foreach( $this->request->data as $key => $datum){
				if(!empty($datum)){
					switch($key){
						case ('year'):
							$conditions['year(CourseDetail.fecha_inicio)'] = $datum;
							break;
						default:
							$conditions[$key] = $datum;
					}
				}
			}
		}

		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 30,
			'fields' => array(
				'Course.nombre',
				'Student.nombre',
				'CourseStudent.id',
				'CourseStudent.student_id',
				'CourseStudent.course_detail_id',
				'CourseStudent.estado_del_pago'),
			'recursive' => -1,
			/**
			  * Cuando realizo la union con la talba Course, ocurren un problema 
			  * porque agrega el join al principio y no al final. Por lo cual,
			  * tengo que hacer los 3 joins manualmente.
			 **/
			'joins' => array(
				array(
					'type' => 'left',
					'table' => 'students',
					'alias' => 'Student',
					'conditions'=> array(
						'Student.id = CourseStudent.student_id')),
				array(
					'type'=> 'left',
					'table' => 'course_details',
					'alias' => 'CourseDetail',
					'conditions'=> array(
						'CourseDetail.id = CourseStudent.course_detail_id')),
				array(
					'type' => 'left',
					'table' => 'courses',
					'alias' => 'Course',
					'conditions'=> array(
						'CourseDetail.course_id = Course.id' ))),
			'conditions' => $conditions
		);

		$this->set('titles', $this->CourseStudent->fields);
		$this->set('data', $this->Paginator->paginate($model));
		$this->set('model', $this->modelClass);
	}

	public function admin_checkout(){

		$params = $this->request->named;

		if ( !(isset($params['nuevo_estado']) ||
			isset($params['course_student_id'])))
		{
			$this->Session->setFlash(
				__('Datos incompletos'),
				'default',
				'alert alert-danger');
			$this->redirect('index');
		}

		$data = array(
			'CourseStudent' => array(
				'id' => $params['course_student_id'],
				'estado_del_pago' => $params['nuevo_estado']));

		if( $this->CourseStudent->save($data))
		{
			$this->Session->setFlash(
				__('Estado de pago actualizado'),
				'default',
				'alert alert-success');
		}else{
			$this->Session->setFlash(
				__('No se pudo cambiar el estado'),
				'default',
				'alert alert-danger');
		}
		$this->redirect('index');
	}
}