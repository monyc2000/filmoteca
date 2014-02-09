<?php

class ShopCategory extends AppModel{
	public $name = 'ShopCategories';
	public $hasMany = 'Item';
	
	public function getAssociatedModel($id){
		
		switch($id){
			case (2):
				return 'Book';
			case (3): 
				return 'Film';
			default:
				return 'Souvenir';
		}
	}
}

