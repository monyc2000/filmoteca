<?php

class CatalogsController extends AppController{

	public function admin_add(){

		if( $this->request->is('post')){

			if( $this->Catalog->save($this->request->data)){
				$this->Session->setFlash(
					__('Catálogo agregado.'), 
					'default',
					array('class'=> 'alert alert-success'));
			}else{
				$this->Session->SetFlash(
					__('No se pudo agregar el catálogo.'),
					'default',
					array('class'=> 'alert alert-danger'));
			}
		}

		$this->set(array(
			'model' => $this->modelClass,
			'fields' => array('legend' => false),
			'fieldsBlackList' => $this->Catalog->fieldsBlackList
			));
	}

	public function admin_delete($id = null){

		if( $id == null ){
			throw new NotFoundException(__('Catálogo no encontrado'));
		}

		$data = $this->Catalog->findById($id);

		if(empty($data) ){
			throw new NotFoundException(__('Catálogo no encontrado'));
		}

		$filename = WWW_ROOT . $data['Catalog']['src'];
		debug($filename);
		if( file_exists($filename) &&
			unlink( $filename) &&
			$this->Catalog->delete($id))
		{
			$this->Session->setFlash(
				__('Catálogo borrado.'),
				'default',
				array('class'=>'alert alert-success'));
		}else{
			$this->Session->setFlash(
				__('No se pudeo borrar el catálogo.'),
				'default',
				array('class'=>'alert alert-danger'));
		}

		$this->redirect(array('action'=> 'index'));
	}

	public function admin_index(){
		
		parent::admin_index();
		$this->set('titles', $this->Catalog->titles);
	}
}