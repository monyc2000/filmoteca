<?php

App::import('Controller', 'DocumentManager.Documents');
App::import('Model', 'DocumentManager.Document');

class EventsDocumentsController extends DocumentsController {

	public function beforeFilter() {
		$this->Document = new Document();
		$workdir = 'files' . DS . 'eventos';

		Configure::write('DocumentManager.baseDir', $workdir);

		if (!(file_exists($workdir))) {
			mkdir($workdir);
		}
		$subdir = (isset($this->passedArgs[0])) ? $this->passedArgs[0] : null;
		if (is_numeric($subdir) &&
				number_format($subdir) &&
				!(file_exists($workdir . DS . $subdir))) {
			mkdir($workdir . DS . $subdir);
		}

		parent::beforeFilter();
	}

	public function admin_index() {
		parent::index();
	}

	public function admin_create_subfolder() {
		parent::create_subfolder();
	}

	public function admin_delete_file() {
		parent::delete_file();
	}

	public function admin_delete_folder() {
		parent::delete_folder();
	}

	public function admin_rename_file() {
		parent::rename_file();
	}

	public function admin_upload_file() {
		parent::upload_file();
	}

}
