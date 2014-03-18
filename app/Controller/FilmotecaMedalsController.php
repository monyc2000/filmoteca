<?php

App::uses('CMSController', 'Controller');

class FilmotecaMedalsController extends CMSController{
	
	public function index(){
		$options = array(
			'fields' => array('id',	'nombre','fecha','foto'));
		$peoples = $this->FilmotecaMedal->find('all',$options);
		$years = $this->FilmotecaMedal->find('years');

		$this->set(compact('peoples','years'));
	}

	public function detail($id = null){

		if( empty($id)){
			throw new NotFoundException(__('Ganador Invalido'));
		}

		$person = $this->FilmotecaMedal->findById($id);

		if (empty($person)){
			throw new NotFoundException(__('Ganador Invalido'));
		}

		$this->set('person',$person['FilmotecaMedal']);

		$this->layout = 'ajax';
	}
}