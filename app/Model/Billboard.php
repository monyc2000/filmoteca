<?php

class Billboard extends AppModel{
	public $name = 'Billboard';
	public $title = 'Cartelera';

	public $fieldsBlackList = array('id');	
	public $titles = array(
		'id' 	=> 'ID',
		'src'	=> 'Link de descarga',
		'href'	=> 'Link a ISSUE');
	public $actions = array('delete');
	public $fields = array(
		'legend' => false,
		'src' => array(
			'label' => 'Cartelera',
			'type' => 'file'),
		'href' => array(
			'label' => 'URL (Dirección web) a versión electronica',
			'type' => 'text'));

	public $notes = "El Formato de la cartelera debe ser PDF.";
	
	/**
	  * Este metodo se encarga de guadar el archivo subido en el 
	  * sistema de archivos.
	  *
	  *	1.- Verificar que la extensión del archivo subido sea correcta.
	  * 2.- Renombrar el archivo a cartelara_timespamp donde timestamp,
	  * 	es la fecha de creación de la cartelera.
	  * 3.- Agregar los campos created_at y src.
	  */
	public function beforeSave($options = array()){

		$file = $this->data[$this->name]['src'];

		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		$regexp = '/pdf/';

		if ( !preg_match($regexp, $ext)){
			return false;
		}

		$newName = 'cartelera_' . date('Y-m-d_H-i-s') . '.' . $ext;
		$destination = WWW_ROOT . 'files' . DS . 'billboards' . DS . $newName;

		if( !move_uploaded_file($file['tmp_name'], $destination)){
			return false;
		}

		$this->data[$this->name]['src'] = '/files/billboards/' . $newName;
	}

	public function beforeDelete($cascade = true){
		$data = $this->findById($this->id);

		$len = strlen($data[$this->name]['src']);
		$path = WWW_ROOT . substr($data[$this->name]['src'],1,$len);

		if( file_exists($path) &&
			!unlink($path)){
			return false;
		}

		return true;

	}

	public function toTable(array $data = array()){

		$newData = array();

		foreach($data as $billboard){

			$newBillboard = array();
			foreach($billboard['Billboard'] as $key => $value ){
				switch($key){
					case ('src'):
						$newBillboard[$key] = '<a href="' . $value . '">' . $value .'</a>';
						break;
					case('href'):
						$newBillboard[$key] = '<a href="' . $value . '">' . $value .'</a>';
						break;
					default:
						$newBillboard[$key] = $value;
				}
			}
			array_push($newData, array('Billboard' => $newBillboard));
		}

		return $newData;
	}

	public function saveSubscriber($email){
		try{
			$this->query(sprintf('insert into subscribers (email) values (\'%s\')', $email));
			return true;
		}catch(Exception $e){
			return false;	
		}
		
	}

	public function unsubscirbe($email){
		try{
			$this->query(sprintf('delete from subscribers where email = \'%s\'', $email));
			return true;
		}catch(Exception $e){
			return false;
		}
	}
}