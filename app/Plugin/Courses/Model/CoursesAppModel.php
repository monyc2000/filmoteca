<?php

class CoursesAppModel extends AppModel {

	public function compact($data, $model) {
		return $data;
	}

	public function getColumnsName(array $blacklist = array()) {
		return array_diff(
				array_keys($this->schema())
				, $blacklist);
	}

}
