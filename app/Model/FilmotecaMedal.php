<?php

class FilmotecaMedal extends AppModel{
	public $name = 'FilmotecaMedal';
	public $title = 'Medalla Filmoteca';

	public $fieldsBlackList = array('id');	
	public $titles = array(
		'id'	=> 'ID',
		'nombre'=> 'Nombre',
		'fecha'	=> 'Fecha en la que se recibio la medalla',
		'biografia' => 'Biografía',
		'foto'	=> 'Foto');

	public $actions = array('delete','detail');
	public $fields = array(
		'legend' => false,
		'nombre',
		'fecha' => array(	
			'label' => 'Fecha en la que recibio la medalla',
			'selected' => '2000-01-01 00:00:00', //Inicializar en el constructor
			'type' => 'date',
			'minYear' => '1880',
			'maxYear' => '2000', //Inicializar en el constructor
			'dateFormat' => 'YMD'),
		'biografia',
		'foto' => array(
			'type' => 'file'));

	public $notes = "El formato de la imagen deber ser jpg o png.";

	public function __construct(){
		$this->fields['fecha']['selected'] = date('Y-m-d') . ' 00:00:00';
		$this->fields['fecha']['maxYear'] = date('Y');
		parent::__construct();
	}

	public function beforeSave($options = array()){

		$file = $this->data[$this->name]['foto'];

		if( $file['error'] != UPLOAD_ERR_OK){
			$this->data[$this->name]['foto'] = 'no-photo.jpg';
			return true;
		}

		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		$regexp = '/jpg|png/';

		if ( !preg_match($regexp, $ext)){
			return false;
		}

		$tableName = Inflector::tableize($this->name);
		$nombre = Inflector::slug($this->data[$this->name]['nombre']);
		$newName = $nombre . '.' . $ext;
		$destination = WWW_ROOT . 'img' . DS . $tableName . DS . $newName;

		//Verificando si el archivo existe.
		$i = 0;
		while (file_exists($destination)){
			$newName = $nombre . '('. $i++ .')' . '.' . $ext;
			$destination = WWW_ROOT . 'img' . DS . $tableName . DS . $newName;
		}
		$this->data[$this->name]['foto'] = $tableName . '/' . $newName;

		return move_uploaded_file($file['tmp_name'], $destination);
	}

	public function beforeDelete($cascade = true){
		$data = $this->findById($this->id);

		$len = strlen($data[$this->name]['foto']);
		$path = WWW_ROOT . 'img' . DS . $data[$this->name]['foto'];

		return ( !file_exists($path) || unlink($path));
	}

	public function toTable(array $data = array()){
		$newData = array();

		foreach($data as $filmotecaMedals){

			$newMedalFilmoteca = array();
			foreach($filmotecaMedals['FilmotecaMedal'] as $key => $value ){
				switch($key){
					case ('foto'):
						$newMedalFilmoteca[$key] = 
						'<img src="/img/' . $value . '" class="thumbnail">';
						break;
					default:
						$newMedalFilmoteca[$key] = $value;
				}
			}
			array_push($newData, array('FilmotecaMedal' => $newMedalFilmoteca));
		}

		return $newData;
	}
}