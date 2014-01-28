<?php

App::uses('Component', 'Controller');

class ImageUploaderComponent extends Component {

	public function uploadImage($prefix, $model, $id, $formData) {
		$filename = $formData[$model][$prefix . '_image']['tmp_name'];
		$name = $prefix . '_' . $id;
		$destination = WWW_ROOT . 'img' . DS . strtolower($model) . 's' . DS . $name . '.jpg';

		if (file_exists($destination)) {
			unlink($destination);
		}

		return move_uploaded_file($filename, $destination);
	}

	public function uploadThem($model, $id, $formData) {
		$imageSizeNote = ' El archivo debe ser menor a ' . ini_get('upload_max_filesize');

		if ($formData[$model]['thumbnail_image']['error'] == UPLOAD_ERR_OK) {
			if (!$this->uploadImage('thumbnail', $model, $id, $formData)) {
				return 'Hubo un problema al subir la imagen en miniatura.'
						. ' <br>' . $imageSizeNote;
			}
		}

		if ($formData[$model]['full_image']['error'] == UPLOAD_ERR_OK) {
			if (!$this->uploadImage('full', $model, $id, $formData)) {
				return 'Hubo un problema al subir la imagen completa.'
						. '<br>' . $imageSizeNote;
			}
		}

		return true;
	}

}
