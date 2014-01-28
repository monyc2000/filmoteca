<?php
/**
 * Description of Genre
 *
 * @author victor
 */
class Genre extends AppModel {
	public $name="Genre";
	public $hasMany = "Film";
}
