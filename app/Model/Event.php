<?php

/**
 * Description of Event
 *
 * @author victor
 */
class Event extends AppModel {

	public $name = "Event";

	public function getFieldInputs($año = 2014) {
		$fields = array('legend' => false);
		$titles = array_keys($this->schema());

		foreach ($titles as $val) {
			switch ($val) {
				case ('año'):
					$fields[$this->name . '.year'] = array(
						'label' => 'Año',
						'selected' => $año . '-01-01 00:00:00',
						'type' => 'date',
						'minYear' => '1880',
						'maxYear' => date('Y'),
						'dateFormat' => 'Y',
						'name' => 'data[' . $this->name . '][año]');
					break;
				default:
					array_push($fields, $this->name . '.' . $val);
			}
		}

		return $fields;
	}

}
