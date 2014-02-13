<?php

/**
 * Description of Page
 *
 * @author victor
 */
class Page extends AppModel {

	public function successUploadingBillboard($filename,$destination) {
		$flash = 'Cartelera guardada.';

		if (file_exists($destination) &&
				unlink($destination)) {
			$flash = 'La cartelera del mes de ' . __(date('F')) . ' del año ' . date('Y') .
					' se a actualizado.';
		}

		if (!move_uploaded_file($filename, $destination)) {
			//enviar masivamente correo.
			$flash = 'Ocurrio un error al guardar el archivo.';
		}
		
		return $flash;
	}
	
	public function generateDestinationUploadedBillboard($destination){
		return $destination;
	}

}
