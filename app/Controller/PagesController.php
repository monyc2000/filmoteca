<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array();

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 * @throws NotFoundException When the view file could not be found
	 * 	or MissingViewException in debug mode.
	 */
	public function display() {

		$path = func_get_args();

		if ($path[0] == 'home') {
			$this->loadModel('Exhibition');

			$films = $this->Exhibition->findByDate(array(
				'month(Timetable.fecha) = ' => date('m')
			));
			$this->set('films', $films);
		}

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function admin_upload_billboard() {


		$subtitle = 'Agregando nueva cartelera.';
		$dir = WWW_ROOT . 'files' . DS . 'carteleras' . DS . date('Y');
		$destination = $dir . DS .
				'cartelera_de_' . strtolower(__((date('F')))) . '_' . date('Y') . '.pdf';
		$permissions = 0777;

		if (!file_exists($dir) &&
				!mkdir($dir, $permissions)) {
			throw new InternalErrorException;
		}

		if (file_exists($destination)) {
			$subtitle = 'La cartelera del mes de '
					. __(date('F')) . ' del año ' . date('Y') . ' ya existe.'
					. ' Si en estos momentos subes la cartelera, se actualizara.';
		}
		
		if ($this->request->is('post') &&
				$this->request->data['cartelera']['type'] == 'application/pdf') {
			
			$this->UploadedFileManager = $this->Components->load('UploadedFileManager');

			$flash = $this->UploadedFileManager->manages(
					array($this->request->data['cartelera'])
					, function($f, $g) {
				return $this->Page->successUploadingBillboard($f, $g);
			}
					, function($a) {
				return $this->Page->generateDestinationUploadedBillboard($a);
			}
					, array($destination));

			$this->Session->setFlash($flash);
		}
	}
	
	public function admin_carteleras(){
		
		/** Codigo agregado para respetar el helper paginator de la pagna
		 * de administración.
		 */
		$this->loadModel('Item');
		$this->Paginator = $this->Components->load('Paginator');
		$this->Paginator->settings = array(
			'limit' => 5
		);
		$data = $this->Paginator->paginate('Item');
		/************************************************************/

		$dir = WWW_ROOT . 'files' . DS . 'carteleras' . DS . date('Y');
		$files = scandir($dir);
		unset($files[0]);
		unset($files[1]);
		$this->set('files', $files);
	}

}
