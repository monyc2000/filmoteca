<?php

class Exhibition extends AppModel {

	public $name = 'Exhibition';
	public $belongsTo = array('Film', 'Auditorium', 'SpecialExhibition');
	public $hasMany = 'Timetable';

	public function findByDate($conditions) {
		return $this->find('all', array(
			'joins' => array(
//				array(
//					'table' => 'exhibitions',
//					'alias' => 'Exhibition',
//					'type' => 'left',
//					'conditions' => array(
//						'Exhibition.id = Timetable.exhibition_id'
//					)
//				),
				array(
					'table' => 'films',
					'alias' => 'Film',
					'type' => 'left',
					'conditions' => array(
						'Film.id = Exhibition.film_id'
					)
				),
				array(
					'table' => 'auditoriums',
					'alias' => 'Auditorium',
					'type' => 'left',
					'conditions' => array(
						'Auditorium.id = Exhibition.auditorium_id'
					)
				),
				array(
					'table' => 'special_exhibitions',
					'alias' => 'SpecialExhibition',
					'type' => 'left',
					'conditions' => array(
						'SpecialExhibition.id = Exhibition.special_exhibition_id'
					)
				),
				array(
					'table' => 'genres',
					'alias' => 'Genre',
					'type' => 'left',
					'conditions' => array(
						'Film.genre_id = Genre.id'
					)
				),
				array(
					'table' => 'timetables',
					'alias' => 'Timetable',
					'type' => 'right',
					'conditions' => array(
						'Exhibition.id = Timetable.exhibition_id'
					)
				)
			),
			'fields' => array(
				'Film.título',
				'Film.id',
				'Auditorium.nombre',
				'SpecialExhibition.nombre',
				'Timetable.fecha',
				'Timetable.hora',
				'Exhibition.id',
				'Genre.género'),
			'conditions' => $conditions,
			'group' => array('Exhibition.id'),
			'recursive' => -1));
	}

}
