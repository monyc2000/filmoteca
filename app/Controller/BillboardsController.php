<?php

App::uses('CMSController', 'Controller');

class BillboardsController extends CMSController{

	/**
	  * Esta función debería ser llamada a travéz de ajax.
	  */
	public function subscribe(){

		$model = $this->modelClass;

		if($this->request->is('post')){
			if( $this->{$model}->saveSubscriber($this->request->data['email']) ){
				$this->set('message', __('Subscrito.'));
				$this->render('/Commons/ajax/success');
			}else{
				$this->set('message', __('El email ya existe.'));
				$this->render('/Commons/ajax/error');
			}

			$this->layout = 'ajax';
		}
	}

	public function unsubscribe($email){

		$model = $this->modelClass;
		if( $this->{$model}->unsubscriber()){
			$this->set('message', __('Ya no recibiras notificaciones.'));
			$this->layout = 'ajax';
			$this->render('/Commons/ajax/success');
		}
		else{
			$this->set('message', __('El email no existe.'));
			$this->layout = 'ajax';
			$this->render('/Commons/ajax/error');
		}
	}

	public function admin_send(){

		$model = $this->modelClass;
		$this->layout = 'ajax';

		$mailsList = array();
		try{
			$mailsList = $this->{$model}->query('select email from subscribers as Subscriber limit 500');
			$lastBillboard = $this->{$model}->find('first',array('order' => array('id DESC')));
		}catch(Exception $e){
			$this->render('/Commons/ajax/error');
			return;
		}

		
		if( empty($lastBillboard)){
			$this->render('/Commons/admin_plus_index');
			return;
		}


		$pdfLink = $lastBillboard['Billboard']['src'];
		$issueLink = $lastBillboard['Billboard']['href'];


		$this->render('/Commons/ajax/success');
		$this->{$model}->sendEmails($mailsList,$pdfLink,$issueLink);
	}
}