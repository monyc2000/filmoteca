<?php

class Catalog extends AppModel{
	public $name = 'Catalog';
	public $allowedTypes = array('pdf');
	public $fieldsBlackList = array('id','uploaded','src');
	public $titles = array(
		array(
			'columnName' => 'id',
			'titleName' => 'ID'),
		array(
			'columnName' => 'src',
			'titleName' => 'Ruta'),
		array(
			'columnName' => 'uploaded',
			'titleName' => 'Subido el'),
		);
	public $path;

	public function __construct(){
		$this->path = 'files' . DS . 'catalogs' . DS;
		parent::__construct();
	}


	public function beforeSave($options = array()){
		$allowedTypes = $this->types;
		$path = $this->path;
		$newData = array();
		$currentDate = date('Ymd');

		$file = $this->data['Catalog']['files'][0];
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

		$regexp = '/'. implode($this->allowedTypes, '|') . '/';
		
		if ( !preg_match($regexp, $ext)){
			return false;
		}

		$name = 'catalogo_' . $currentDate . '.' . $ext ;
		$cPath = WWW_ROOT . $path . $name;


		if( ! move_uploaded_file( $file['tmp_name'], $cPath)){
			return false;
		}

		$newData['Catalog']['src'] = $this->path . $name;
		$newData['Catalog']['uploaded'] = $currentDate;

		$this->data = $newData;

		return true;
	}
}