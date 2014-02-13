<?php

/**
 * Por el momento, solamente regresa una cadena con el error asosociado
 * al archivo subido o regresa lo que regrese la función success pasada como
 * segundo argumento.
 * 
 *
 * @author victor
 */
class UploadedFileManagerComponent extends Component {

	/**
	 * Regresa un mensaje de lo que ocurrio el o los archivos. En caso de exito
	 * regresa lo que regrese la función de exito (success).
	 * 
	 * @param array $files lista de arreglos de la información del archivo subido.
	 * @param function $success Función que se ejecuta si el archivo se subio 
	 * correctamente. Recibe dos parámetros obligatorios, $filename (archivo temporal)
	 *  y $detination (a donde se movera el archivo).
	 * @param string
	 * @return string Mesaje de lo ocurrido.
	 */
	public function manages($files, $success, $generateDestination, $detinationArgs) {

		foreach ($files as $file) {

			$tmpFilename = $file['tmp_name'];
			$destination = call_user_func_array($generateDestination, $detinationArgs);

			switch ($file['error']) {
				case (UPLOAD_ERR_OK):
					$flash = call_user_func_array($success,array($tmpFilename,$destination));
					break;
				case (UPLOAD_ERR_INI_SIZE):
					$flash = 'El tamaño del archivo exede el tamaño maximo permitido.'
							. ' El cual es ' . get_init('post_max_size');
					break;
				case (UPLOAD_ERR_FORM_SIZE):
					$flash = 'El tamño del archivo exede lo especificado en el'
							. 'formulario.';
					break;
				CASE (UPLOAD_ERR_PARTIAL):
					$flash = 'El archivo no pudo ser subido completamente.';
					break;
				case(UPLOAD_ERR_NO_FILE):
					$flash = 'Ningun archivo subido.';
					break;
				case (UPLOAD_ERR_NO_TMP_DIR):
					$flash = 'No existe un directorio temporal';
					break;
				case (UPLOAD_ERR_CANT_WRITE):
					$flash = 'No fue posible escribir en disco.';
					break;
				case (UPLOAD_ERR_EXTENSION):
					$flash = 'La extensión del archivo no es correcta.';
					break;
			}
		}
		return $flash;
	}

}
